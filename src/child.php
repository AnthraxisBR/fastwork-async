<?php

$file = 'file.txt';

include '../vendor/autoload.php';


//$file = $argv[0];
$serialized = $argv[1];

$handle = fopen($file,'w') or die('asdasdsad');


$a = new \Opis\Closure\SerializableClosure($argv[1]);
fwrite($handle,json_encode($a->unserialize()));
