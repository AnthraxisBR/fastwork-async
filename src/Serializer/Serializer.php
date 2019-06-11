<?php

namespace AnthraxisBR\FwAsync\Serializer;


use Opis\Closure\SerializableClosure;

class Serializer
{

    public $wrapper;

    public $serialized;

    public $closure;

    public function __construct(SerializableClosure $wrapper)
    {
        $this->wrapper = $wrapper;
    }

    public function serialize()
    {
        $serializable = $this->wrapper->serialize();
        $this->serialized = serialize($this->wrapper);
        return $this->serialized;
    }

    public function unserialize()
    {
        $this->closure = unserialize($this->serialized);
        return $this->closure;
    }

}