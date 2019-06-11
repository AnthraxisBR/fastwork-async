<?php


namespace AnthraxisBR\FwAsync\Process;

class LockHandle
{

    public $handle;

    public function __construct()
    {

        //$file = getenv('root_folder') . 'src/file.txt';//$argv[0];
        //$this->handle = fopen($file,'a+') or die('error on open process handler');

    }

    public static function getHandle()
    {
        $file = getenv('root_folder') . 'files/process';//$argv[0];
        $handle = fopen($file,'a+') or die('error on open process handler');
        return $handle;
    }
}