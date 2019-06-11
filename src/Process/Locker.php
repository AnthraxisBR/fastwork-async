<?php

namespace AnthraxisBR\FwAsync\Process;

class Locker
{

    public $handle;

    public $write_count = 1;

    public $pid;

    public function __construct()
    {
        $this->handle = LockHandle::getHandle();
    }

    public function write($txt)
    {
        $head = '#' . $this->write_count . ' PID: ' . $this->pid . ' ';

        $head .= $txt . PHP_EOL;
        fwrite($this->handle, $head);
        $this->write_count += 1;
    }

    public function lock()
    {
        return flock($this->handle, LOCK_EX);
    }

    public function hardLock()
    {
        return flock($this->handle, LOCK_EX, 1);
    }

    public function unlock()
    {
        return flock($this->handle, LOCK_UN);
    }
}