<?php
$start = microtime(true);

//$str = '#1 [PID=' . getmypid() . ', StartedAt=' . date('Y-m-d H:i:s.u T') . ']' . PHP_EOL;

include 'vendor/autoload.php';

$serialized = $argv[1];

$dotenv = \Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

return new \AnthraxisBR\FWasync\Task\Receiver($start, $serialized);



$file = getenv('root_folder') . 'files/process.lock';//$argv[0];

$handle = fopen($file,'a+') or die('error on open process handler');

fwrite($handle,$str);


$serialized = $argv[1];

fwrite($handle,'#2 unserializing ' . PHP_EOL);

$closure = unserialize($serialized);

fwrite($handle,'#3 Executing ' . get_class($closure) . PHP_EOL);

$closure();

$time_elapsed_secs = microtime(true) - $start;

fwrite($handle,'#4 [PID=' . getmypid() . ', EndedAt=' . date('Y-m-d H:i:s.u T') . ', ElapsedTime=' . $time_elapsed_secs .']' . PHP_EOL);