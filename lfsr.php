<?php
error_reporting(E_ERROR);
define('BIN', "10010000");

// 2 chars for <?

// 96; in ISO-8859-1, iterate first time or as long as input != $output, do LFSR
for($o=$s=BIN;!$i++||$o!=$s;){echo$s,~õ;$s=(($s[0]^$s[1]^$s[3]^$s[6]^$s[7])&1).substr($s,0,-1);}

// 91; in ISO-8859-1, iterate first time or as long as input != $output, do LFSR
for($o=$s=BIN;!$i++||$o!=$s;print$s.~õ,$s=($s[0]^$s[1]^$s[3]^$s[6]^$s[7]).substr($s,0,-1));

// 89; in ISO-8859-1, iterate first time or as long as input != $output, do LFSR
for($o=$s=BIN;!$i++||$o!=$s;$s=($s[0]^$s[1]^$s[3]^$s[6]^$s[7]).substr($s,0,-1))echo$s.~õ;

// 87; in ISO-8859-1, iterate first time or as long as input != $output, do LFSR
for($s=BIN;!$i++||BIN!=($s=($s[0]^$s[1]^$s[3]^$s[6]^$s[7]).substr($s,0,-1));)echo$s.~õ;

// 87; in ISO-8859-1, iterate first time or as long as input != $output, do LFSR
for($s=BIN;!$i++||BIN!=$s;$s=($s[0]^$s[1]^$s[3]^$s[6]^$s[7]).substr($s,0,-1))echo$s.~õ;

// TODO
//for($s=BIN;($n=$s[$i+1])!="";$t=$s[$i],$s[$n?$i:0]=$t,$t=$n)echo$s.~o;

