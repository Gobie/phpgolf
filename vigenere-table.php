<?php
error_reporting(E_ERROR);

// always 2 bytes for <? !!!

// 48 bytes
// Observation: Render canvas 26*27 and each char at the end of line replace with newline, that looks like rotation.
// Iterate 26*27 lines*chars, each 27th char put newline instead of char.
for(;$i++<702;)echo$i%27?chr(($i-1)%26+65):~õ;

// 49 bytes
// Observation: Let's move that ternary operator and newline char inside.
// Iterate 26*27 lines*chars, each 27th char put newline instead of char.
for(;$i++<702;)echo chr($i%27?65+($i-1)%26:10);

// 46 bytes
// Observation: Let's use incrementing chars.
// iterate 26*27 lines*chars from AAA, each 27 char put \n instead of last char of string
for($a=AAA;$i++<702;$a++)echo$i%27?$a{2}:~õ;

// 46 bytes
// Observation: Let's drop that char count, use string instead.
// iterate from AAA to BAZ, each 27 char put \n instead of char
for($a=AAA;$a<BAZ;$a++)echo++$i%27?$a{2}:~õ;
