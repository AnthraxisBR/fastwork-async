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
        $this->setStartedMicrotime($started_microtime);

        $this->setLocker(new Locker());

        $this->setPid(getmypid());

        $this->setFilebase(new ProcessFilebase());

        $this->getLocker()->setPid($this->pid);

        $this->setStartedAt(date('Y-m-d H:i:s.u T'));

        $this->getFilebase()->addProcess([
            'pid' => $this->pid,
            'status' => 'running', // running|stoped|broken
            'started_at' => $this->started_at
        ]);
    }

    public function start($closure)
    {
        $str = '[StartedAt=' . $this->started_at . ']';

        $this->getLocker()->write($str);

        $closure($this->getLocker());

        $this->setElapsedTime(microtime(true) - $this->getStartedMicrotime());

        $this->setEndedAt(date('Y-m-d H:i:s.u T'));

        $str = '[EndedAt=' . $this->getEndedAt() . ', ElapsedTime=' . $this->getElapsedTime() .']';

        $this->getLocker()->write($str);
    }

    /**
     * @return Locker
     */
    public function getLocker()
    {
        return $this->locker;
    }

    /**
     * @param Locker $locker
     */
    public function setLocker($locker)
    {
        $this->locker = $locker;
    }

    /**
     * @return bool
     */
    public function isStarted()
    {
        return $this->started;
    }

    /**
     * @param bool $started
     */
    public function setStarted($started)
    {
        $this->started = $started;
    }

    /**
     * @return false|string
     */
    public function getStartedAt()
    {
        return $this->started_at;
    }

    /**
     * @param false|string $started_at
     */
    public function setStartedAt($started_at)
    {
        $this->started_at = $started_at;
    }

    /**
     * @return mixed
     */
    public function getStartedMicrotime()
    {
        return $this->started_microtime;
    }

    /**
     * @param mixed $started_microtime
     */
    public function setStartedMicrotime($started_microtime)
    {
        $this->started_microtime = $started_microtime;
    }

    /**
     * @return mixed
     */
    public function getEndedAt()
    {
        return $this->ended_at;
    }

    /**
     * @param mixed $ended_at
     */
    public function setEndedAt($ended_at)
    {
        $this->ended_at = $ended_at;
    }

    /**
     * @return mixed
     */
    public function getEndedMicrotime()
    {
        return $this->ended_microtime;
    }

    /**
     * @param mixed $ended_microtime
     */
    public function setEndedMicrotime($ended_microtime)
    {
        $this->ended_microtime = $ended_microtime;
    }

    /**
     * @return mixed
     */
    public function getElapsedTime()
    {
        return $this->elapsed_time;
    }

    /**
     * @param mixed $elapsed_time
     */
    public function setElapsedTime($elapsed_time)
    {
        $this->elapsed_time = $elapsed_time;
    }

    /**
     * @return int
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param int $pid
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    }

    /**
     * @return ProcessFilebase
     */
    public function getFilebase()
    {
        return $this->filebase;
    }

    /**
     * @param ProcessFilebase $filebase
     */
    public function setFilebase($filebase)
    {
        $this->filebase = $filebase;
    }

    /**
     * @return array
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * @param array $process
     */
    public function setProcess($process)
    {
        $this->process = $process;
    }


}