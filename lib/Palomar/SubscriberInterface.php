<?php 

namespace Palomar;

interface SubscriberInterface
{
    public function getSubscriptions();

    public function notify();
}