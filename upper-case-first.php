<?php
error_reporting(E_ALL^E_NOTICE^E_DEPRECATED);
define('STR', 'hello world!');

// 38 bytes
// Observation: Regular expression is first choice as 'ucfirst ucwords mb_convert_case' are disabled
// We take first letter of each word and apply binary trick. 'letter'&ß = 'uppercase letter'
<?=preg_filter('/\b\w/e','$0&ß',STR);

// 35 bytes
// Observation: What about using ~ as negation of strings, it helps a lot
// It helps in regex, but ~ß is space and that will break the code as parser tokenizes on whitespace characters 
// After a bit of research, I found out I don't really need 'ß' (11011111), '_' (1011111) is enough
file_put_contents('run.php','<?=preg_filter(~'. ~'/\b\w/e' . ',~' . ~'$0&_' . ',STR);');