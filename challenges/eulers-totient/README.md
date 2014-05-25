# Challenge: Euler's totient

Find [Euler's totient](http://en.wikipedia.org/wiki/Euler's_totient_function) of a given value.

The value will be random decimal number.

Example with the given value of 36:

First find all prime factors of the value.

```
36|2
18|2
 9|3
 3|3
 1
```

Which means that `36 = 2^2 * 3^2`.

Then we can use this formula:
`Pi^Ai - Pi^(Ai-1)`

In this case:
`(2^2 - 2^1)(3^2 - 3^1) = 2 * 6 = 12`