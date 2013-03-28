<?php

namespace Abdulklarapl\Components\EventDispatcher\Event;

/**
 * Class Event
 *
 * @package Abdulklarapl\Components\EventDispatcher\Event
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
class Event extends EventArray implements EventInterface
{

    /**
     * @var boolean
     */
    private $propagationIsStopped;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->propagationIsStopped = false;
    }

    /**
     * stop propagation of event
     */
    public function stopPropagation()
    {
        $this->propagationIsStopped = true;
    }

    /**
     * @return boolean
     */
    public function isPropagationStopped()
    {
        return $this->propagationIsStopped;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}