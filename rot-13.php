<?php
error_reporting(E_ALL^E_NOTICE^E_DEPRECATED);
define('WORD', 'abcdefghijklmnopqrstuvwxyz');
?>

// 73 bytes
<?=strtr(WORD,'abcdefghijklmnopqrstuvwxyz','nopqrstuvwxyzabcdefghijklm');

// 66 bytes
<?=strtr(WORD,join(range(a,z)),join(range(n,z)).join(range(a,m)));

// 59 bytes
<?for($a=WORD;$c=$a[$i++];)echo chr(ord($c)+($c>m?-13:13));

// 58 bytes
<?=preg_filter('/\w/e','chr(ord($0)+($0>m?-13:13))',WORD);

// 57 bytes
<?=preg_filter('/\w/e','chr(ord($0)-14+($0<n)*26)',WORD);

// 55 bytes
<?=preg_filter('/\w/e','chr((ord($0)-84)%26+97)',WORD);

// 54 bytes
<?=preg_filter('/./e','chr((ord($0)-84)%26+97)',WORD);
