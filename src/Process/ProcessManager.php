<?php

namespace AnthraxisBR\FwAsync\Process;

use AnthraxisBR\FwAsync\Filebase\ProcessFilebase;
use Symfony\Component\Process\Process;

class ProcessManager
{

    public $locker;

    public $started = false;

    public $started_at;

    public $started_microtime;

    public $ended_at;

    public $ended_microtime;

    public $elapsed_time;

    public $pid;

    public $filebase;

    public $process = [
        'pid' => 0,
        'status' => 'running', // running|stoped|broken
        'started_at' => ''
    ];

    public function __construct($started_microtime)
    {
        $this->started_microtime = $started_microtime;

        $this->locker = new Locker();
        $this->locker->write('asdasdsad');

        $this->pid = getmypid();

        $this->filebase = new ProcessFilebase();

        $this->locker->pid = $this->pid;

        $this->started_at = date('Y-m-d H:i:s.u T');

        $this->process = [
            'pid' => $this->pid,
            'status' => 'running', // running|stoped|broken
            'started_at' => $this->started_at
        ];

        $this->filebase->addProcess($this->process);
    }

    public function start($closure)
    {
        $str = '[StartedAt=' . $this->started_at . ']';

        $this->locker->write($str);

        $closure($this->locker);

        $this->elapsed_time = microtime(true) - $this->started_microtime;

        $this->ended_at = date('Y-m-d H:i:s.u T');

        $str = '[EndedAt=' . $this->ended_at . ', ElapsedTime=' . $this->elapsed_time .']';

        $this->locker->write($str);
    }

}