# [phpGolf](http://www.phpgolf.org/) challenges

My attempts on PHP code golf challenges, usually with several of them for each challenge.

- [Euler's totient](./challenges/eulers-totient)
- [Fibonacci](./challenges/fibonacci)
- [Juggler Sequence](./challenges/juggler-sequence)
- [LFSR](./challenges/lfsr)
- [Minesweeper](./challenges/minesweeper)
- [Pacman](./challenges/pacman)
- [Rot 13](./challenges/rot-13)
- [Saving Time](./challenges/saving-time)
- [Triangular Numbers](./challenges/triangular-numbers)
- [Upper Case First](./challenges/upper-case-first)
- [Vigenere Table](./challenges/vigenere-table)

# Installation

Run `php composer.phar install` and the challenge runner is ready.

# Challenge runner

I also created challenge run to test quickly my attempts on challenges.
It is CLI tool written in PHP for testing attempts individually or in a batch.

You can run any challenge with

```
php cli.php challenge:run challenge-name [attempt-number, ...]
```

Structure of the project is

```
challenges
- challenge-name <-- name of the challenge
  - attempt-number <-- number of the attempt
    - attempt.php <-- attempt, that is run
    - README.md <-- description of this attempt
  - attempt-number
    - attempt.php
    - attempt_generator.php <-- attempt generator, that generates attempt.php, it is optional
    - README.md
  ...
  - tests.php <-- tests for all attempts
  - README.md <-- description of this challenge
- challenge-name
  ...
...
```