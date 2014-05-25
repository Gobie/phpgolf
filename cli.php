<?php

if (!$loader = include __DIR__.'/vendor/autoload.php') {
    die('You must set up the project dependencies.');
}

$app = new \Cilex\Application('phpGolf Challenge Test Runner');
$app->command(new \Gobie\Command\ChallengeCommand());
$app->run();