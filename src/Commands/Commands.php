<?php

namespace AnthraxisBR\FwAsync\Commands;

include "../../vendor/autoload.php";

use AnthraxisBR\AdvancedTyping\Types\ListObjects;
use AnthraxisBR\FwAdvancedCollection\Collection\Collection;
use AnthraxisBR\FwAsync\Methods\Assync;
use AnthraxisBR\FwAsync\Task\Execute;
use Dotenv\Dotenv;
use Opis\Closure\SerializableClosure;

class Commands
{

    /**
     *
     * @var ListObjects()
     */
    public $commands = [];

    public function __construct()
    {

    }


    /**
     * @return void
     */
    public function addCommand($command): void
    {
        $this->commands[] = $command;
    }

    /**
     * @return ListObjects
     */
    public function getCommands(): ListObjects
    {
        return $this->commands;
    }

    /**
     * @param ListObjects $commands
     */
    public function setCommands(ListObjects $commands): void
    {
        $this->commands = $commands;
    }


    public function boot()
    {
        $this->commands = new Collection($this->commands);
        $this->commands->each(function(Assync $command) {
            $closure = $command->closure;

            $wrapper = new SerializableClosure($closure);
            (new Execute($wrapper, $command->await))();
        });
    }
}

$dotenv = \Dotenv\Dotenv::create('/home/gabriel/PhpstormProjects/fastwork-async/');
$dotenv->load();

var_dump(getenv('root_folder'));

$a = new Commands();

$a->addCommand((new Assync(function(){
    return \AnthraxisBR\FwAsync\Sum::sum(2,5);
}))->await());

$a->boot();