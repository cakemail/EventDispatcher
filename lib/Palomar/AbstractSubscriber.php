<?php 

namespace Palomar;

abstract class AbstractSubscriber
{
    abstract public function getSubscriptions();

    public function notify($eventName)
    {
        $subscriptions = $this->getSubscriptions();
        $method = $subscriptions[$eventName];
        $args = array_slice(func_get_args(), 1);

        call_user_func_array(array($this, $method), $args);
    }
}