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

return '<?for($r="'.$r.'";$c=ord($r[$i++]);)echo str_repeat($c&64?~�:~�,$c&63).($c&128?~�:"");';