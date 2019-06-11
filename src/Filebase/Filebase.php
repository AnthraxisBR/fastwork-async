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

/*
$database = new \Filebase\Database([
    'dir' => '/home/gabriel/PhpstormProjects/fastwork-async/database'
]);

// in this example, you would search an exact user name
// it would technically be stored as user_name.json in the directories
// if user_name.json doesn't exists get will return new empty Document
$item = $database->get('teste2');

// display property values
echo $item->first_name;
echo $item->last_name;
echo $item->email;

// change existing or add new properties
$item->email = 'example@example.com';
$item->tags  = ['php','developer','html5'];

// need to save? thats easy!
$item->save();*/