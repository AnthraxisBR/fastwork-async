<?php


namespace AnthraxisBR\FwAsync\Methods;

class Assync
{

    public $await = false;

    public $closure;

    public function __construct($closure)
    {
        $this->closure = $closure;
    }


    public function await()
    {
        $this->await = true;
        return $this;
    }

    public function __sleep()
    {

    }

}