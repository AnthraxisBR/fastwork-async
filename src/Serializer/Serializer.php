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
        $this->setWrapper($wrapper);
    }

    public function serialize()
    {
        $this->setSerialized(serialize($this->wrapper));
        return $this->getSerialized();
    }

    public function unserialize()
    {
        $this->setClosure(unserialize($this->getSerialized()));
        return $this->getClosure();
    }

    /**
     * @return SerializableClosure
     */
    public function getWrapper(): SerializableClosure
    {
        return $this->wrapper;
    }

    /**
     * @param SerializableClosure $wrapper
     */
    public function setWrapper(SerializableClosure $wrapper): void
    {
        $this->wrapper = $wrapper;
    }

    /**
     * @return mixed
     */
    public function getSerialized()
    {
        return $this->serialized;
    }

    /**
     * @param mixed $serialized
     */
    public function setSerialized($serialized): void
    {
        $this->serialized = $serialized;
    }

    /**
     * @return mixed
     */
    public function getClosure()
    {
        return $this->closure;
    }

    /**
     * @param mixed $closure
     */
    public function setClosure($closure): void
    {
        $this->closure = $closure;
    }


}