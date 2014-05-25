<?php
$define = base64_decode($argv[1]);
$attemptPath = $argv[2];

eval($define);
require_once $attemptPath;