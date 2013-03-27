<?php

namespace Abdulklarapl\Components\EventDispatcher\Event;

/**
 * Class EventInterface
 *
 * @package Abdulklarapl\Components\EventDispatcher\Event
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
interface EventInterface
{

    /**
     * @return boolean
     */
    public function isPropagationStopped();

    /**
     * @return string
     */
    public function getName();
}