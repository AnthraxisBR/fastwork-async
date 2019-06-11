<?php


namespace AnthraxisBR\FwAsync\Task;


use AnthraxisBR\FwAsync\Methods\Assync;
use AnthraxisBR\FwAsync\Serializer\Serializer;
use Opis\Closure\SerializableClosure;

class Execute
{

    public $wrapper;

    public $await;

    public function __construct(SerializableClosure $wrapper, $await)
    {
        $this->wrapper = $wrapper;
        $this->await = $await;
    }

    public function __invoke()
    {

        var_dump($this->wrapper->getClosure());
        $serializer = new Serializer($this->wrapper);

        if($this->await){
            $command ='php -f /home/gabriel/PhpstormProjects/fastwork-async/src/exec.php \'' . $serializer->serialize() . '\' > /dev/null 2>&1 &';

            $pid = exec($command, $output);
        var_dump($output);
            return $output;
        }else{
            $command ='php -f /home/gabriel/PhpstormProjects/fastwork-async/src/exec.php \'' . $serializer->serialize() . '\'';
            exec($command);
            return true;
        }
    }
}