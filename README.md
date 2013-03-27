EventDispatcher
===============

- clone via git: `git clone git@github.com:abdulklarapl/EventDispatcher.git`

About
-----

Abdulklarapl's EventDispatcher is a simply and light event dispatcher. Let's build your own system using abdulklarapl's components!

Example
-------

First, create your subscriber:
```
<?php

namespace Acme\EventSubscriber;

use Abdulklarapl\Components\EventDispatcher\Subscriber\SubscriberInterface;
use Abdulklarapl\Components\EventDispatcher\Event\Event;


class SampleSubscriber implements SubscriberInterface
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
        // I just handled the event!
    }
}
```


Then, create new instance of EventDispatcher:
```
$subscriber = new SampleSubscriber();

$dispatcher = new Dispatcher();
$dispatcher->addSubscriber($subscriber);

$dispatcher->fire('foo.bar');
```

Stop propagation
----------------

If you don't want to event was propagated after your subscribed calls, you can modify the event:

```
public function fooAction(Event $event)
{
	$event->stopPropagation();
}
```