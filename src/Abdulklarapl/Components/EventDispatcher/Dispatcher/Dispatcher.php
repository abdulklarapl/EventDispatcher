<?php

namespace Abdulklarapl\Components\EventDispatcher\Dispatcher;

use Abdulklarapl\Components\EventDispatcher\Subscriber\InvalidSubscriberException,
    Abdulklarapl\Components\EventDispatcher\Subscriber\SubscriberInterface;
use Abdulklarapl\Components\EventDispatcher\Event\Event;
use Abdulklarapl\Components\EventDispatcher\Event\EventInterface;

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

            if ($this->isThereNoSimilarSubscriber($event, $subscriber, $method)) {
                $this->subscribers[$event][] = array($subscriber, $method);
            }
        }
    }

    /**
     * check, if in subscribers dosn't exist similar subscriber already
     *
     * @param string $event
     * @param SubscriberInterface $subscriber
     * @param string $method
     *
     * @return bool
     */
    private function isThereNoSimilarSubscriber($event, $subscriber, $method)
    {
        if (empty($this->subscribers[$event])) {
            return true;
        }

        foreach ($this->subscribers[$event] as $singleSubscriber) {
            if ($singleSubscriber == array($subscriber, $method)) {
                return false;
            }
        }
        return true;
    }

    /**
        $app = $this->applications->get($calledApp, InternalApplication::EVENT_HELP);
     * @param $eventName
     */
    public function fire($eventName, EventInterface $event = null)
    {
        if (!empty($this->subscribers[$eventName])) {
            if (!$event) {
                $event = new Event($eventName);
            }

            foreach ($this->subscribers[$eventName] as $subscriber) {
                call_user_func_array(array($subscriber[0], $subscriber[1]), array($event));
                if ($event->isPropagationStopped() === true) {
                    break;
                }
            }
        }
    }
}