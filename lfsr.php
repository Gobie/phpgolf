<?php
error_reporting(E_ERROR);
define('BIN', "10010000");

// always 2 bytes for <? !!!

// 98 bytes
// Observation: Let's use LFSR in its simplest.
// Iterate first time or as long as input != $output, do LFSR.
for($o=$s=BIN;!$i++||$o!=$s;){echo$s,~õ;$s=(($s[0]^$s[1]^$s[3]^$s[6]^$s[7])&1).substr($s,0,-1);}

// 93 bytes
// Observation: Let's clean that up a bit.
// Iterate first time or as long as input != $output, do LFSR.
for($o=$s=BIN;!$i++||$o!=$s;print$s.~õ,$s=($s[0]^$s[1]^$s[3]^$s[6]^$s[7]).substr($s,0,-1));

// 91 bytes
// Observation: Move printing in it's own statement.
// Iterate first time or as long as input != $output, do LFSR.
for($o=$s=BIN;!$i++||$o!=$s;$s=($s[0]^$s[1]^$s[3]^$s[6]^$s[7]).substr($s,0,-1))echo$s.~õ;

// 89 bytes
// Observation: Use BIN constant everywhere as it is shorter, then storing it in variable.
// Iterate first time or as long as input != $output, do LFSR.
for($s=BIN;!$i++||BIN!=($s=($s[0]^$s[1]^$s[3]^$s[6]^$s[7]).substr($s,0,-1));)echo$s.~õ;

// 89 bytes
// Observation: Move statements around, it doesn't help anyways.
// Iterate first time or as long as input != $output, do LFSR.
for($s=BIN;!$i++||BIN!=$s;$s=($s[0]^$s[1]^$s[3]^$s[6]^$s[7]).substr($s,0,-1))echo$s.~õ;

// TODO
//for($s=BIN;($n=$s[$i+1])!="";$t=$s[$i],$s[$n?$i:0]=$t,$t=$n)echo$s.~o;

