<?php
error_reporting(E_ERROR);

// 2 chars for <?

// 46; in ISO-8859-1, iterate 26*27 lines*chars, each 27 char put \n instead of char
for(;$i++<702;)echo$i%27?chr(($i-1)%26+65):~õ;

// 47; iterate 26*27 lines*chars, each 27 char put \n instead of char
for(;$i++<702;)echo chr($i%27?65+($i-1)%26:10);

// 44; in ISO-8859-1, iterate 26*27 lines*chars from AAA, each 27 char put \n instead of char
for($a=AAA;$i++<702;$a++)echo$i%27?$a{2}:~õ;

// 44; in ISO-8859-1, iterate from AAA to BAZ, each 27 char put \n instead of char
for($a=AAA;$a<BAZ;$a++)echo++$i%27?$a{2}:~õ;
