<?php

namespace Abdulklarapl\Components\EventDispatcher\Subscriber;

/**
 * Class SubscriberInterface
 *
 * @package Abdulklarapl\Components\EventDispatcher\Subscriber
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
interface SubscriberInterface
{

    /**
     * return all subscribed events
     * pattern:
     * (string)[event] => (string)'nameOfMethod'
     *
     * @return array
     */
    public function getSubscribedEvents();
}