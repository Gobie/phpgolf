<?php
error_reporting(E_ALL^E_NOTICE);

// 40 bytes
// Observation: We can use Fibonacci from 1 and add 0 at the beginning.
// We use $i = a(n) - a(n-2), which is a(n-1). Then $j = $i + a(n), which is a(n+1) = a(n-1) + a(n).
0<?for($j=1;2e6>$j+=$i=$j-$i;)echo~õ,$i;

// 39 bytes
// Observation: Let's optimize the starting value.
0<?for(;9e5>$j+=$i?:1;)echo~õ,$i=$j-$i;