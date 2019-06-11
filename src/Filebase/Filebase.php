<?php


namespace AnthraxisBR\FwAsync\Filebase;

use Filebase\Database;

class Filebase extends Database
{
    public $database;

    public function __construct(array $config = [])
    {

        parent::__construct([
            'dir'            => getenv('root_folder') . 'database',
        //    'format'         => \Filebase\Format\Json::class,
        ]);
    }

}
