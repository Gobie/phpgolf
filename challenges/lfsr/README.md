# Challenge: LFSR

Generate the output of an LFSR.

The LFSR uses this polynomial:
`f(x) = 1 + x^8 + x^7 + x^5 + x^2 + x^1`

The binary representation of the polynomial:
`11010011`

The visual representation:
```
 ---->
|
|-->[x^8][x^7][x^6][x^5][x^4][x^3][x^2][x^1]
|     |    |         |              |    |
|     v    v         v              v    v
\----(+)<-(+)<------(+)<-----------(+)<--/
```

The initial value is given in the constant BIN and will be 8 bits.

With the initial value 10010000 the algorithm will be:
```
x^1 xor x^2 = a
a xor x^5 = b
b xor x^7 = c
c xor x^8
```

With the actual numbers:
```
0 xor 0 = 0
0 xor 1 = 1
1 xor 0 = 1
1 xor 1 = 0
```

The initial value is then logicaly right shifted with the result (0).

The next value is then `01001000`.

Repeat this until you end up with the initial value again.