<?php

namespace AnthraxisBR\FWasync\Task;

include '../../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::create('/home/gabriel/PhpstormProjects/fastwork-async');
$dotenv->load();

use AnthraxisBR\FwAsync\Process\Locker;
use AnthraxisBR\FwAsync\Process\ProcessManager;

class Receiver
{

    /**
     * @var
     */
    public $closure;

    /**
     * @var
     */
    public $process_manager;

    public function __construct($started, $serialized)
    {
        $this->setClosure(unserialize($serialized));

        $this->setProcessManager(new ProcessManager($started));

        $this->startProcess();
    }

    public function startProcess()
    {
        $this->getProcessManager()->start(function(Locker $locker){
            $locker->write('Running ');
            $this->run();
        });
    }


    public function run()
    {
        $closure = $this->closure;
        return $closure();
    }

    /**
     * @return ProcessManager
     */
    public function getProcessManager()
    {
        return $this->process_manager;
    }

    /**
     * @param ProcessManager $process_manager
     */
    public function setProcessManager($process_manager)
    {
        $this->process_manager = $process_manager;
    }



    /**
     * @return mixed
     */
    public function getClosure()
    {
        return $this->closure;
    }

    /**
     * @param mixed $closure
     */
    public function setClosure($closure)
    {
        $this->closure = $closure;
    }


}

//$r = new Receiver(microtime(true),'');