<?php

namespace Gobie\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Gobie\Challenge;

class ChallengeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('challenge:run')
            ->setDescription('Run challenge')
            ->addArgument('name', InputArgument::REQUIRED, 'What challenge to run?')
            ->addArgument('attempt', InputArgument::IS_ARRAY, 'If set, runs only specified attempts, otherwise runs all', array());
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $attempts = $input->getArgument('attempt');

        $challenge = new Challenge($output, $name);
        $challenge->run($attempts);
    }
}