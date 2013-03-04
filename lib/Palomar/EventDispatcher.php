<?php

namespace Palomar;

/**
 * The smallest observer EVER
 */
class EventDispatcher
{
    protected $subscriptions = array();

    public function attach(AbstractSubscriber $subscriber)
    {
        $subscriptions = $subscriber->getSubscriptions();

        foreach($subscriptions as $eventName => $method) {
            if(false === array_key_exists($eventName, $this->subscriptions)) {
                $this->subscriptions[$eventName] = array();
            }
            $this->subscriptions[$eventName][] = $subscriber;
        }
    }

    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    public function notify($eventName)
    {
        if(array_key_exists($eventName, $this->subscriptions)) {
            foreach($this->subscriptions[$eventName] as $subscriber) {
                call_user_func_array(array($subscriber, 'notify'), func_get_args());
            }
        }
    }
}