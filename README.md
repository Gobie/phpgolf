# [phpGolf](http://www.phpgolf.org/) challenges

Some of my tries on PHP code golf challenges.

- [Euler's totient](./challenges/eulers-totient)
- [Fibonacci](./challenges/fibonacci)
- [Juggler Sequence](./challenges/juggler-sequence)
- [LFSR](./challenges/lfsr)
- [Minesweeper](./challenges/minesweeper)
- [Rot 13](./challenges/rot-13)
- [Vigenere Table](./challenges/vigenere-table)

# Challenge runner

I also created challenge run to test quickly my attempts on challenges.
It is CLI tool written in PHP for testing attempts individually or in a batch.

You can run it using:

```
php cli.php challenge:run challenge-name [attempt-number, ...]
```

Structure of the project is:

```
challenges
- challenge-name
  - attempt-number
    - attempt.php
    - README.md
  - attempt-number
    - attempt.php
    - README.md
  ...
  - tests.php
  - README.md
- challenge-name
  ...
...
```