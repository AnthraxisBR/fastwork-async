<?php

//echo __DIR__;
include '/home/gabriel/PhpstormProjects/fastwork-async/vendor/autoload.php';


$file = '/home/gabriel/PhpstormProjects/fastwork-async/src/file.txt';//$argv[0];

$serialized = $argv[1];

$handle = fopen($file,'w') or die('asdasdsad');

$closure = unserialize($serialized);

fwrite($handle,$closure());

exit();
