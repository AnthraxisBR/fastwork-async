<?php

namespace AnthraxisBR\FWasync\Task;

include '../../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::create('/home/gabriel/PhpstormProjects/fastwork-async');
$dotenv->load();

use AnthraxisBR\FwAsync\Process\Locker;
use AnthraxisBR\FwAsync\Process\ProcessManager;

class Receiver
{

    public $closure;

    public function __construct($started, $serialized)
    {
        //$this->closure = unserialize($serialized);

        $processManager = new ProcessManager($started);

        $processManager->start(function(Locker $locker){
            $locker->write('Running ');
            //$this->run();
        });
    }


    public function run()
    {
        return $this->closure();
    }

}

$r = new Receiver(microtime(true),'');