<?php

namespace Abdulklarapl\Components\EventDispatcher\Dispatcher;

use Abdulklarapl\Components\EventDispatcher\Subscriber\InvalidSubscriberException,
    Abdulklarapl\Components\EventDispatcher\Subscriber\SubscriberInterface;
use Abdulklarapl\Components\EventDispatcher\Event\Event;

/**
 * Class Dispatcher
 *
 * @package Abdulklarapl\Components\EventDispatcher\Dispatcher
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
class Dispatcher implements DispatcherInterface
{

    /**
     * @var array
     */
    private $subscribers;

    public function __construct()
    {
    }

    /**
     * @param SubscriberInterface $subscriber
     *
     * @throws \Abdulklarapl\Components\EventDispatcher\Subscriber\InvalidSubscriberException
     */
    public function addSubscriber(SubscriberInterface $subscriber)
    {
        $subscribedEvents = $subscriber->getSubscribedEvents();
        foreach ($subscribedEvents as $event => $method) {
            if (!method_exists($subscriber, $method)) {
                throw new InvalidSubscriberException(sprintf(
                        "Subscriber %s has no method %s for event %s",
                        get_class($subscriber),
                        $method,
                        $event
                    ));
            }

            $this->subscribers[$event][] = array($subscriber, $method);
        }
    }

    /**
     * @param $eventName
     */
    public function fire($eventName)
    {
        if (!empty($this->subscribers[$eventName])) {
            $event = new Event($eventName);

            foreach ($this->subscribers[$eventName] as $subscriber) {
                call_user_func_array(array($subscriber[0], $subscriber[1]), array($event));
                if ($event->isPropagationStopped() === true) {
                    break;
                }
            }
        }
    }
}