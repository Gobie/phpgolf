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
            $h = 1 << 7;
            break;
        default:
            return $matches[1];
    }

    return chr($h | strlen($matches[0]));
}, $data);

return '<?for($r="'.$r.'";$c=ord($r[$i++]);)echo$c==10?chr($c):str_repeat(($c&(1<<7))?"@":" ",$c&63);';