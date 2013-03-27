<?php

namespace Abdulklarapl\Tests\Resources\EventDispatcher;

use Abdulklarapl\Components\EventDispatcher\Subscriber\SubscriberInterface;
use Abdulklarapl\Components\EventDispatcher\Event\Event;

/**
 * Class SecondSubscriber
 *
 * @package Abdulklarapl\Tests\Resources\EventDispatcher
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
class SecondSubscriber implements SubscriberInterface
{

    public function getSubscribedEvents()
    {
        return array(
            "foo.bar" => 'fooAction'
        );
    }

    /**
     * method that it's called on 'event.foo'
     *
     * @param Event $event
     */
    public function fooAction(Event $event)
    {
        $_SESSION['event.foo.2'] = rand(0, 10);
    }
}