<?php


namespace AnthraxisBR\FwAsync\Process;

class LockHandle
{

    public $handle;

    public static function getHandle()
    {
        $file = getenv('root_folder') . 'files/process';//$argv[0];
        $handle = fopen($file,'a+') or die('error on open process handler');
        return $handle;
    }
}