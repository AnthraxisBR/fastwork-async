<?php


namespace AnthraxisBR\FwAsync\Filebase;


class ProcessFilebase extends Filebase
{



    public function __construct(array $config = [])
    {
        parent::__construct([]);

        $this->database = $this->get('process');
    }

    public function addProcess($pid){
        $this->database->process[] = $pid;
        $this->database->save();
    }
/*
    public function save()
    {

    }*/
}
