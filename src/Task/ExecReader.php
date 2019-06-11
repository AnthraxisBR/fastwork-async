<?php


namespace AnthraxisBR\FwAsync\Task;


class ExecReader
{
    public function __construct()
    {
        if(func_num_args() > 1){
            $exec_args = func_get_args();
            $class = $exec_args[0];
            unset($exec_args[0]);
            $function = $exec_args[1];
            unset($exec_args[1]);
            $exec_args = array_values($exec_args);
            if(count($exec_args) > 0){
                $args = $exec_args;
            }
        }
        $this->call($class, $function, $args);
    }

    public function call($class, $function, $args)
    {
        return new Receiver(function() use($class, $function, $args) {( new $class())->{$function}($args); });
    }
}