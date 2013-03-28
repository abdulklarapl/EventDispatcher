<?php

namespace Abdulklarapl\Tests\Components\EventDispatcher;

session_start();

use Abdulklarapl\Tests\Resources\EventDispatcher\BrokenSubscriber,
    Abdulklarapl\Tests\Resources\EventDispatcher\SampleSubscriber;
use Abdulklarapl\Components\EventDispatcher\Dispatcher\Dispatcher;
use Abdulklarapl\Components\EventDispatcher\Subscriber\InvalidSubscriberException;
use Abdulklarapl\Tests\Resources\EventDispatcher\SecondSubscriber;

/**
 * Class EventDispatcherTest
 *
 * @package Abdulklarapl\Tests\Components\EventDispatcher
 * @author Patryk (Abdulklarapl) Szlagowski <szlagowskipatryk@gmail.com>
 */
class EventDispatcherTest extends \PHPUnit_Framework_TestCase
{

    /**
     * event fire test
     */
    public function testAddSubscriber()
    {
        $subscriber = new SampleSubscriber();

        $dispatcher = new Dispatcher();
        $dispatcher->addSubscriber($subscriber);

        $dispatcher->fire('foo.bar');
        $this->assertArrayHasKey('event.foo', $_SESSION);
    }

    /**
     * add broken (without necessary methods) subscribber
     *
     * @expectedException Abdulklarapl\Components\EventDispatcher\Subscriber\InvalidSubscriberException
     */
    public function testAddBrokenSubscriber()
    {
        $subscriber = new BrokenSubscriber();

        $dispatcher = new Dispatcher();
        $dispatcher->addSubscriber($subscriber);
    }

    /**
     * stop event propagation in first subscriber
     */
    public function testStopPropagationEvent()
    {
        $subscriber = new SampleSubscriber();
        $subscriber2 = new SecondSubscriber();

        $dispatcher = new Dispatcher();
        $dispatcher->addSubscriber($subscriber);
        $dispatcher->addSubscriber($subscriber2);

        $dispatcher->fire('foo.bar');

        $this->assertArrayNotHasKey('event', $_SESSION);
    }

    /**
     * test if event has array access
     */
    public function testEventArrayAccess()
    {
        $subscriber = new SampleSubscriber();
        $subscriber2 = new SecondSubscriber();

        $dispatcher = new Dispatcher();
        $dispatcher->addSubscriber($subscriber2);
        $dispatcher->addSubscriber($subscriber);

        $dispatcher->fire('foo.bar');
        
        $this->assertNotEmpty($_SESSION['event']);
        $this->assertEquals('bar', $_SESSION['event']['foo']);
    }
}