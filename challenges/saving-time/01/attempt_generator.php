<?php
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

return '<?for($r=\''.$r.'\',$h=($t=TIME)%12,$m=$t[3]*2+($t[4]>4);$v=$i%2?11.5-$i/2:$i/2,$c=ord($r[$i++]);)echo str_repeat(~õ,$c&3),str_repeat(\' \',($c&61)/4),($v^$h||$h^$m?$h^$v?$m^$v?o:m:h:x);';