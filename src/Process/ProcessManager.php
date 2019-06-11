<?php

namespace AnthraxisBR\FwAsync\Process;

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

    public function __construct($started_microtime)
    {
        $this->started_microtime = $started_microtime;

        $this->locker = new Locker();

        $this->pid = getmypid();

        $this->locker->pid = $this->pid;

        $this->started_at = date('Y-m-d H:i:s.u T');

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