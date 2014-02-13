<?php
error_reporting(E_ERROR);
define('NUM', 36);

// always 2 bytes for <? !!!

// 78 bytes
// Observation: What about using GCD to tackle this one?
// Iterate over <0,NUM) and do gcd($i,NUM) and count when divisor is 1.
for(;NUM>$i;$w+=$c==1,++$i)for($c=$i,$d=NUM;$d;$r=$c%$d,$c=$d,$d=$r);echo$w;

// 80 bytes
// Observation: We could try one for loop, if it helps.
// Iterate over <0,NUM) and do gcd($i,NUM) and count when last remaining is <2 as it is 0 or 1.
for(;NUM>$i+=!$d;$c=$d?$c:$i,$d=$d?:NUM,$r=$c%$d,$c=$d,$d=$r,$o+=$c<2);echo$o;

// 78 bytes
// Observation: Let's clean that for loop a bit.
// Iterate over <0,NUM) and do gcd($i,NUM) and count when last remaining is <2 as it is 0 or 1.
for(;NUM>$i+=!$d;){$d?:($c=$i)&&$d=NUM;$r=$c%$d;$o+=($c=$d)<2;$d=$r;}echo$o;

// 75 bytes
// Observation: Let's try Euler's product formula.
// Divide NUM by primes > 2 until 1 is left calculating formula `n*product over d|n (1-1/d)` where d is distinct prime divisor.
// There is some fun using variable variables for getting distinct prime divisors.
for($r=$s=NUM,$j=2;$s^1;$s%$j?$j++:($r*=$$j?:++$$j-1/$j)&&$s/=$j);echo$r;
