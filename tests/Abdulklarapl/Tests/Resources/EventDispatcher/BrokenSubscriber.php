<?php

namespace Abdulklarapl\Tests\Resources\EventDispatcher;

use Abdulklarapl\Components\EventDispatcher\Subscriber\SubscriberInterface;
use Abdulklarapl\Components\EventDispatcher\Event\Event;

/**
 * Class BrokenSubscriber
 *
 * @package Abdulklarapl\Tests\Resources\EventDispatcher
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
class BrokenSubscriber implements SubscriberInterface
{

    /**
     * this method returns array with information about non-existing method
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            "event.foo" => 'fooAction'
        );
    }
}