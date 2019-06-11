<?php


namespace AnthraxisBR\FwAsync\Task;


use AnthraxisBR\FwAsync\Methods\Assync;
use AnthraxisBR\FwAsync\Serializer\Serializer;
use Opis\Closure\SerializableClosure;

class Execute
{

    /**
     * @var void
     */
    public $wrapper;

    /**
     * @var void
     */
    public $await;

    public function __construct(SerializableClosure $wrapper, bool $await)
    {
        $this->setWrapper($wrapper);
        $this->setAwait($await);
    }

    public function __invoke()
    {

        $serializer = new Serializer($this->getWrapper());

        if($this->getAwait()){
            $command ='php -f ' . getenv('root_folder') . 'exec.php \'' . $serializer->serialize() . '\' > /dev/null 2>&1 &';

            $pid = exec($command, $output);
            return $output;
        }else{
            $command ='php -f ' . getenv('root_folder') . 'exec.php \'' . $serializer->serialize() . '\'';
            exec($command);
            return true;
        }
    }

    /**
     * @return SerializableClosure
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * @param SerializableClosure $wrapper
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     * @return mixed
     */
    public function getAwait()
    {
        return $this->await;
    }

    /**
     * @param mixed $await
     */
    public function setAwait($await)
    {
        $this->await = $await;
    }


}