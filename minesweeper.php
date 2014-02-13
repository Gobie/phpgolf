<?php
error_reporting(E_ALL^E_NOTICE);
define('MAP',
"........X....X....X.........X.X.X..X.......X...X..
.........XX....X......X...X..X.....X............X.
....XX......X......................X........X....X
.X....X..........X.X.......X..XX........X.X.X....X
X.X................X...X...X..X.........X.X.X....X
.....X.......X.X.....X.X...X...XX........X........
......X.............................X.....XX...XX.
..X.X...........X...X..X....X.X..........X.X..XXX.
..X..X....XX.....X......X....X....X...X.X....X.X.X
..X.X.....X............X........X...X.X........X..
.X..X.X..X...X...X...........X.XX..............X.X
..............XX....X.X.....X...X.X.X.X...........
X..X.....X.X........XX..........X.....X.....X.X...
..X........X......X...X..XXX..XX.X..XXX....X...XXX
.........X.....XX.X..XX....X..X...X...XXX.........
........X.XXX..X..X..XXX.........X..XX.X..X..XX..X
..X.......X.....X...XX.XX..X..X.......X.X.X...X...
....X............X...................X........X...
X..X........XX.....X...X....X..XX.X..XX...........
...X...X...X..X..X.X............XX.....X.XX.......
....XX...X....X...X..X........X............X......
........XX.XXX...XX....................X....X.....
...X..............X.....X...X........XX...........
.XXX........X...........X....X..X...X.....X.X.....
..X.XX....................XX......X.............X.
.........X.X.....X.XX....X...XX.......X.......XX..
....X..X....X...X...X.XX...X...XX..X.............X
....X.....X..X...........X.X...X................X.
..X......XX.X..X...X..........X.......XX.X.......X
.....X........X...........X..X....XX.XX.X.....X..X");

// always 2 bytes for <? !!!

// 127 bytes
// Observation: We could iterate over each char and for each "." count surrounding "X" chars, that's it.
// The surrounding positions relative to current char are listed in an array.
for($d=MAP;$c=$d[$i++];print$c==~Ñ&&$n?$n:$c)for($j=$n=0,$p=array(-1,1,-52,-51,-50,50,51,52);$m=$p[$j++];$n+=$d[$i-1+$m]==X);

// 113 bytes
// Observation: We could drop that array and use 3x3 matrix.
// Iterate over matrix (-1,0,1)x(-1,0,1) and sum "X" chars.
for($d=MAP;$c=$d[$i++];print$c==~Ñ&&$n?$n:$c)for($m=-2,$n=0;++$m<2;)for($k=-2;++$k<2;$n+=$d[$i-1+$m*51+$k]==X);

// 111 bytes
// Observation: Clean up simple arithmetic.
for($d=MAP;$c=$d[$i++];print$c==~Ñ&&$n?$n:$c)for($m=-2,$n=0;++$m<2;)for($k=-3;++$k<1;$n+=$d[$i+$m*51+$k]==X);

// 109 bytes
// Observation: Move condition for "." to inner loop, so we can use shortened ternary operator.
for($d=MAP;$c=$d[$i++];print$n?:$c)for($m=-2,$n=0;$c==~Ñ&&++$m<2;)for($k=-3;++$k<1;$n+=$d[$i+$m*51+$k]==X);

// 101 bytes
// Observation: Let's try to remove that 3rd for.
// We iterate over <0-8> and transform values on the run.
for($d=MAP;$c=$d[$i++];print$n?:$c)for($m=-1,$n=0;$c==~Ñ&&++$m<9;$n+=$d[$i+($m%3-1)*51+$m/3-2]==X);

// 98 bytes
// Observation: Clean up simple arithmetic.
for($d=MAP;$c=$d[$i++];print$n?:$c)for($m=-1,$n=0;$c==~Ñ&&++$m<9;$n+=$d[$i+$m%3*51+$m/3-53]==X);

// 95 bytes
// Observation: $m could be 0 to shorten it, how would I do that?
// Moved incrementation at the end so we can start from 0.
for($d=MAP;$c=$d[$i++];print$n?:$c)for($m=$n=0;$c==~Ñ&&$m<9;$n+=$d[$i+$m%3*51+$m++/3-53]==X);

// 94 bytes
// Observation: Use variable variables.
// Summing values can use variable variable instead of custom variable.
for($d=MAP;$c=$d[$i++];print$$i?:$c)for($m=0;$c==~Ñ&&$m<9;$$i+=$d[$i+$m%3*51+$m++/3-53]==X);

