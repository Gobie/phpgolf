<?php
error_reporting(E_ERROR);
define('NUM', 36);

// 2 chars for <?

// 76; iterate over gcd($i,NUM) and count when divisor is 1
for(;NUM>$i;$w+=$c==1,++$i)for($c=$i,$d=NUM;$d;$r=$c%$d,$c=$d,$d=$r);echo$w;

// 78; iterate over gcd($i,NUM) and count when divisor is 1
for(;NUM>$i+=!$d;$c=$d?$c:$i,$d=$d?:NUM,$r=$c%$d,$c=$d,$d=$r,$o+=$c<2);echo$o;

// 76; iterate over gcd($i,NUM) and count when divisor is 1
for(;NUM>$i+=!$d;){$d?:($c=$i)&&$d=NUM;$r=$c%$d;$o+=($c=$d)<2;$d=$r;}echo$o;

// 73; divide NUM by primes > 2 until 1 is left calculating formula `n*product over d|n (1-1/d)` where is distinct prime divisor
for($r=$s=NUM,$j=2;$s^1;$s%$j?$j++:($r*=$$j?:++$$j-1/$j)&&$s/=$j);echo$r;
