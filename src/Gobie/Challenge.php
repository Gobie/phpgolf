<?php

namespace Gobie;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Output\OutputInterface;

class Challenge
{
    const ATTEMPT_FILENAME = 'attempt.php';
    const ATTEMPT_GENERATOR_FILENAME = 'attempt_generator.php';
    const TESTS_FILENAME = 'tests.php';

    private $challengePath;
    private $iniEntries;

    public function __construct($output, $challengeName)
    {
        $challengePath = $this->joinPath('challenges', $challengeName);
        if (!file_exists($challengePath)) {
            throw new \InvalidArgumentException("Challenge at '$challengePath' doesn't exist.");
        }

        $this->output = $output;
        $this->challengePath = $challengePath;
        $this->iniEntries = array(
            'short_tags' => 'on',
            'precision' => '12',
            'allow_url_fopen' => 'off',
            'max_input_time' => '2',
            'max_execution_time' => '8',
            'magic_quotes_gpc' => 'off',
            'memory_limit' => '1M',
            'error_reporting' => E_ALL & ~E_NOTICE & ~E_DEPRECATED
        );
    }

    public function run($attempts)
    {
        $attempts = $this->getAttempts($attempts);
        $tests = $this->getTests();

        /** @var $attemptFilePath \Symfony\Component\Finder\SplFileInfo */
        foreach ($attempts as $attemptFilePath) {
            $this->output->writeln($attemptFilePath->getPathname());
            foreach ($tests as $testName => $testData) {
                $verboseInput = OutputInterface::VERBOSITY_VERBOSE <= $this->output->getVerbosity()
                    ? PHP_EOL . "== Given input =="
                    . PHP_EOL . $testData['input']
                    : '';

                try {
                    $this->verify($attemptFilePath, $testData);

                    $verboseInput .= OutputInterface::VERBOSITY_VERBOSE <= $this->output->getVerbosity()
                        ? PHP_EOL . "== Expected output =="
                        . PHP_EOL . $testData['output']
                        : '';

                    $this->output->write($this->indent("$testName => PASSED", 2) . $this->indent($verboseInput, 4));
                } catch (\DomainException $e) {
                    $diff = PHP_EOL . "== Expected output =="
                        . PHP_EOL . $testData['output']
                        . PHP_EOL . '== Actual output =='
                        . PHP_EOL . $e->getMessage();

                    $this->output->writeln($this->indent("$testName => FAILED", 2) . $this->indent($verboseInput . $diff, 4));
                } catch (\RuntimeException $e) {
                    $diff = PHP_EOL . "== Expected output =="
                        . PHP_EOL . $testData['output']
                        . PHP_EOL . '== Actual output =='
                        . PHP_EOL . $e->getMessage();

                    $this->output->writeln($this->indent("$testName => CRASHED", 2) . $this->indent($verboseInput . $diff, 4));
                }
                $this->output->writeln('');
            }
            $this->output->writeln('');
        }
    }

    private function getAttempts($attempts)
    {
        $this->generateAttempts($attempts);

        return $this->findFiles($attempts, self::ATTEMPT_FILENAME);
    }

    private function generateAttempts($attempts)
    {
        $attemptGeneratorFiles = $this->findFiles($attempts, self::ATTEMPT_GENERATOR_FILENAME);
        foreach ($attemptGeneratorFiles as $attemptGeneratorFile) {
            $attemptFile = str_replace('_generator', '', $attemptGeneratorFile);
            file_put_contents($attemptFile, include $attemptGeneratorFile);
        }
    }

    private function findFiles($dirs, $filename)
    {
        $finder = new Finder();
        $finder->files()
            ->name($filename);

        if (!$dirs) {
            return $finder->in($this->challengePath);
        }

        foreach ($dirs as $dir) {
            $finder->in($this->joinPath($this->challengePath, $dir));
        }

        return $finder;
    }

    private function getTests()
    {
        return include $this->joinPath($this->challengePath, self::TESTS_FILENAME);
    }

    private function verify($attemptFilePath, $testData)
    {
        $output = $this->execute($attemptFilePath, $testData['input']);

        if (!empty($testData['options']['full-trim'])) {
            $output = trim($output);
        } else if (!empty($testData['options']['right-trim'])) {
            $output = rtrim($output);
        }

        if ((string)$output !== (string)$testData['output']) {
            throw new \DomainException($output);
        }
    }

    private function execute($attemptFilePath, $input)
    {
        $command = array('php -f runner.php');
        foreach ($this->iniEntries as $key => $value) {
            $command[] = '-d ' . escapeshellarg($key) . '=' . escapeshellarg($value);
        }
        $command[] = '--';
        $command[] = escapeshellarg(base64_encode($input));
        $command[] = escapeshellarg($attemptFilePath);
        $commandline = implode(' ', $command);

        $process = new Process($commandline);
        $process->setTimeout(30);
        $process->run();

        if (!$process->isSuccessful()) {
            $msg = OutputInterface::VERBOSITY_VERBOSE <= $this->output->getVerbosity()
                ? $commandline . PHP_EOL
                : '';
            $msg .= '[' . $process->getExitCode() . '] ' . $process->getExitCodeText() . PHP_EOL . $process->getErrorOutput();
            throw new \RuntimeException($msg);
        }

        return $process->getOutput();
    }

    private function joinPath()
    {
        return implode(DIRECTORY_SEPARATOR, func_get_args());
    }

    private function indent($string, $numSpaces)
    {
        $spaces = str_repeat(' ', $numSpaces);
        $lines = explode("\n", $string);
        $indentedLines = array_map(function ($line) use ($spaces) {
            return $spaces . $line;
        }, $lines);

        return implode("\n", $indentedLines);
    }
}