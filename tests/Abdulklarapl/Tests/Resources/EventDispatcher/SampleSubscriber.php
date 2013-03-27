<?php

namespace Abdulklarapl\Tests\Resources\EventDispatcher;

use Abdulklarapl\Components\EventDispatcher\Subscriber\SubscriberInterface;
use Abdulklarapl\Components\EventDispatcher\Event\Event;

/**
 * Class SampleSubscriber
 *
 * @package Abdulklarapl\Tests\Resources\EventDispatcher
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
class SampleSubscriber implements SubscriberInterface
{

    public function getSubscribedEvents()
    {
        return array(
            "foo.bar" => 'fooAction'
        );
    }

    /**
     * method that it's called on 'event.foo' - stop propagation
     *
     * @param Event $event
     */
    public function fooAction(Event $event)
    {
        $event->stopPropagation();
        $_SESSION['event.foo'] = rand(0, 10);
    }
}