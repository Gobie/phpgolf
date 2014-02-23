<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
define('TIME', "01:54");


// 188 bytes
// Observation: Let's try compression of clock and replace 'o' values on decompression.
$data = ''
        . '        o' . "\n"
        . '    o       o' . "\n"
        . "\n"
        . ' o             o' . "\n"
        . "\n"
        . 'o               o' . "\n"
        . "\n"
        . ' o             o' . "\n"
        . "\n"
        . '    o       o' . "\n"
        . '        o';

$r = preg_replace_callback('/(\\n*)( *)o/', function ($matches) {
    $h = $matches[1] ? strlen($matches[1]) : 0;

    return chr($h | (strlen($matches[2]) << 2));
}, $data);

file_put_contents('t.php','<?for($r=\''.$r.'\',$h=($t=TIME)%12,$m=$t[3]*2+($t[4]>4);$v=$i%2?11.5-$i/2:$i/2,$c=ord($r[$i++]);)echo str_repeat(~õ,$c&3),str_repeat(\' \',($c&61)/4),($v^$h||$h^$m?$h^$v?$m^$v?o:m:h:x);');


// 205 bytes
// Observation: Let's try computation of the clock.

// $c 0 1  0 1  0 1 0 1 0 1 0 1 0 1
// $i 0 0  1 1  2 2 3 3 4 4 5 5 6 6
// $v 0 0 11 1 10 2 9 3 8 4 7 5 6 -

// Formulae for altering whitespaces
// f(i) -> 15 - 2*i
//  8  4  1  0  1 4  8
//  -1 7 13 15 13 7 -1
for ($h = ($t = TIME) % 12,
     $m = $t[3] * 2 + ($t[4] > 4);

    // even/odd 0 1 2 ...
     $c = $j++ % 2,
    // rendered number
     $v = !$c ? $i ? 12 - $i : 0 : $i,
    // 8 4 2 1 2 4 8
     $u = 1 << abs($i - 3),
    // 8 4 1 0 1 4 8
     $u -= 1 < $i && $i < 5,
    // 8 4 1 0 1 4 8 or -1 7 13 15 13 7 -1
     $f = $c ? 15 - 2 * $u : $u,
    // till we are at the end and move every 2nd
     !$c | ($i += $c) ^ 7;
)
    echo $f < 0
        ? ~õ
        : str_repeat(' ', $f)
          . ($v ^ $h || $h ^ $m ? $h ^ $v ? $m ^ $v ? o : m : h : x)
          . ($c ? $i > 1 && $i < 6 ? ~õõ : ~õ : '');