<?php

namespace Abdulklarapl\Components\EventDispatcher\Event;

/**
 * Class Event
 *
 * @package Abdulklarapl\Components\EventDispatcher\Event
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
abstract class EventArray implements \ArrayAccess
{

    /**
     * @var array
     */
    private $bag = array();

    /**
     * @param string $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        if (!empty($this->bag[$offset])) {
            return true;
        }
        return false;
    }

    /**
     * @param string $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->bag[$offset];
        }
        return null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value) {
        $this->bag[$offset] = $value;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetUnset($offset) {
        if ($this->offsetExists($offset)) {
            unset($this->bag[$offset]);
            return true;
        }
        return false;
    }
}