<?php
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

return '<?for($r="'.$r.'";$c=ord($r[$i++]);)echo str_repeat($c&128?~�:($c&64?~�:~�),$c&63);';