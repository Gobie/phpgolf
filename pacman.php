<?php
error_reporting(E_ERROR);

// always 2 bytes for <? !!!

$data = ''
        . '        @@@@@@@@@@@@@@@@@@            ' . "\n"
        . '    @@@@@@@@@@@@@@@@@@@@@@@@@@        ' . "\n"
        . '  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@      ' . "\n"
        . '@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@    ' . "\n"
        . '@@@@@@@@@@@@@@      @@@@@@@@@@@@@@@@  ' . "\n"
        . '    @@@@@@@@@@@@  @@@@@@@@@@@@@@@@@@  ' . "\n"
        . '      @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '            @@@@@@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '              @@@@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '                @@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '              @@@@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '            @@@@@@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '      @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@' . "\n"
        . '    @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ' . "\n"
        . '@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ' . "\n"
        . '@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    ' . "\n"
        . '  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@      ' . "\n"
        . '    @@@@@@@@@@@@@@@@@@@@@@@@@@        ' . "\n"
        . '        @@@@@@@@@@@@@@@@@@            ';

// Not done
// Observation: It could be described as canvas limited with ellipsis, circle and few lines.
// ... well, that went wrong, a lot of code is needed to describe desired ellipsis.

// 270 bytes
// Observation: There is a lot of repeating chars, let's try RLE to compress it and use stored data + decompression as result.
// I used RLE to compress data and wrote decompression algorithm for RLE.
preg_replace_callback('/(.)(\d+)/s',function($m){echo str_repeat($m[1],+$m[2]);},' 8@18 12
1 4@26 8
1 2@30 6
1@16 2@16 4
1@14 6@16 2
1 4@12 2@18 2
1 6@32
1 8@30
1 12@26
1 14@24
1 16@22
1 14@24
1 12@26
1 8@30
1 6@32
1 4@32 2
1@36 2
1@34 4
1 2@30 6
1 4@26 8
1 8@18 12');

// 163 bytes in pacman_run.php
// Observation: We have only alphabet with 3 chars " ", "@", "\n" and reasonably short sequences, let's encode it in one byte.
// Compression takes ' ' or '@' and sets 1st bit to differentiate char, rest of the byte is then used for storing number of repeating characters
// newline is left as it is and is treated separately in decompression.
// Decompression algorithm with compressed data is printed into pacman_run.php.
$r = preg_replace_callback('/(.)\1*/s', function ($matches) {
    switch ($matches[1]) {
        case ' ':
            $h = 0;
            break;
        case '@':
            $h = 1 << 7;
            break;
        default:
            return $matches[1];
    }

    return chr($h | strlen($matches[0]));
}, $data);

file_put_contents('pacman_run.php', '<?for($r="'.$r.'";$c=ord($r[$i++]);)echo$c==10?chr($c):str_repeat(($c&(1<<7))?"@":" ",$c&63);');

// 153 bytes in pacman_run.php
// Observation: Max sequence is 36 chars, which means last 6 bits is enough for encoding sequence length, we can use first 2 bits for differentiating chars.
// Compression takes ' ', '@' or "\n" and sets first 2 bits to differentiate char, rest of the byte is then used for storing number of repeating characters
// Decompression algorithm with compressed data is printed into pacman_run.php
$r = preg_replace_callback('/(.)\1*/s', function ($matches) {
    switch ($matches[1]) {
        case ' ':
            $h = 0;
            break;
        case '@':
            $h = 64;
            break;
        default:
            $h = 128;
            break;
    }

    return chr($h | strlen($matches[0]));
}, $data);

file_put_contents('pacman_run.php', '<?for($r="'.$r.'";$c=ord($r[$i++]);)echo str_repeat($c&128?~õ:($c&64?~¿:~ß),$c&63);');

// 144 bytes in pacman_run.php
// Observation: newline is there always once, no repeating and on known position. So to use 1 byte for each newline is wasting bytes.
// Compression takes ' ', '@' and sets 2nd bit to differentiate char, rest of the byte is then used for storing number of repeating characters
// After every 38 char, put newline
// Decompression algorithm with compressed data is printed into pacman_run.php
// This was actually wrong, as it put LF at the very end, where it shouldn't be.
$r = preg_replace_callback('/(.)\1*/s', function ($matches) {
    switch ($matches[1]) {
        case ' ':
            $h = 0;
            break;
        case '@':
            $h = 64;
            break;
        default:
            return '';
    }


    return chr($h | strlen($matches[0]));
}, $data);

file_put_contents('pacman_run.php', '<?for($r="'.$r.'";$c=ord($r[$i++]);)echo str_repeat($c&64?~¿:~ß,$c&63).(($j+=$c&63)%38?"":~õ);');

// 136 bytes in pacman_run.php
// Observation: Removing newline from compressed data makes decompression longer so let's store it in character sequence just before newline as there is 1st bit free
// Compression takes ' ', '@' and sets 2nd bit to differentiate char, rest of the byte is then used for storing number of repeating characters
// Decompression algorithm with compressed data is printed into pacman_run.php
$r = preg_replace_callback('/(.)\1*(\\n?)/', function ($matches) {
    switch ($matches[1]) {
        case ' ':
            $h = 0;
            if ($matches[2]) $h |= 128;
            break;
        case '@':
            $h = 64;
            if ($matches[2]) $h |= 128;
            break;
        default:
            break;
    }

    return chr($h | (strlen($matches[0]) - strlen($matches[2])));
}, $data);

file_put_contents('pacman_run.php', '<?for($r="'.$r.'";$c=ord($r[$i++]);)echo str_repeat($c&64?~¿:~ß,$c&63).($c&128?~õ:"");');

// 134 bytes in pacman_run.php
// Observation: Sequences are always multiples of 2, which means we have last bit free for use. Let's store newline there, as "&1" is shorter then "&128".
// Compression takes ' ', '@' and sets 2nd bit to differentiate char, bits 3-7 are then used for storing number of repeating characters
// Decompression algorithm with compressed data is printed into pacman_run.php
$r = preg_replace_callback('/(.)\1*(\\n?)/', function ($matches) {
    switch ($matches[1]) {
        case ' ':
            $h = 0;
            if ($matches[2]) $h |= 1;
            break;
        case '@':
            $h = 64;
            if ($matches[2]) $h |= 1;
            break;
        default:
            break;
    }

    return chr($h | (strlen($matches[0]) - strlen($matches[2])));
}, $data);

file_put_contents('pacman_run.php', '<?for($r="'.$r.'";$c=ord($r[$i++]);)echo str_repeat($c&64?~¿:~ß,$c&62).($c&1?~õ:"");');
