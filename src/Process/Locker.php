<?php

namespace AnthraxisBR\FwAsync\Process;

class Locker
{

    public $handle;

    public $write_count = 1;

    public $pid;

    public function __construct()
    {
        $this->setHandle(LockHandle::getHandle());
    }

    public function write($txt)
    {
        $head = '#' . $this->write_count . ' PID: ' . $this->pid . ' ';

        $head .= $txt . PHP_EOL;

        fwrite($this->getHandle(), $head);

        $this->countWrite();
    }

    private function countWrite()
    {
        $this->write_count += 1;
    }

    public function lock()
    {
        return flock($this->getHandle(), LOCK_EX);
    }

    public function hardLock()
    {
        return flock($this->getHandle(), LOCK_EX, 1);
    }

    public function unlock()
    {
        return flock($this->getHandle(), LOCK_UN);
    }

    /**
     * @return bool|resource
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param bool|resource $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return int
     */
    public function getWriteCount()
    {
        return $this->write_count;
    }

    /**
     * @param int $write_count
     */
    public function setWriteCount($write_count)
    {
        $this->write_count = $write_count;
    }

    /**
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param mixed $pid
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    }


}