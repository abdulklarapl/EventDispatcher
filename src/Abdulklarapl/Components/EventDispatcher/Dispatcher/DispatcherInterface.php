<?php

namespace Abdulklarapl\Components\EventDispatcher\Dispatcher;

use Abdulklarapl\Components\EventDispatcher\Subscriber\SubscriberInterface;

/**
 * DispatcherInterface
 *
 * @package Abdulklarapl\Components\EventDispatcher\Dispatcher
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
interface DispatcherInterface
{
    /**
     * @param SubscriberInterface $subscriber
     */
    public function addSubscriber(SubscriberInterface $subscriber);

    /**
     * @param string $eventName
     */
    public function fire($eventName);
}