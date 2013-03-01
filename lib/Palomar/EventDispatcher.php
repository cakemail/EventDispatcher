<?php

namespace Palomar;

/**
 * The smallest observer EVER
 */
class EventDispatcher
{
    protected $subscriptions = array();

    public function attach(SubscriberInterface $subscriber)
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
        $args = array_slice(func_get_args(), 1);

        if(array_key_exists($eventName, $this->subscriptions)) {
            foreach($this->subscriptions[$eventName] as $subscriber) {
                call_user_func_array(array($subscriber, 'notify'), $args);
            }
        }
    }
}