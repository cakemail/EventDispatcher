<?php

class ObserverTest extends PHPUnit_Framework_TestCase
{

    public function testGetsSubscriptionsFromSubscriber()
    {
        $observer = new Palomar\EventDispatcher;
        $subscriber = $this->getMock('Palomar\AbstractSubscriber');
        
        $subscriber->expects($this->once())
             ->method('getSubscriptions')
             ->will($this->returnValue(array(
                'user.login' => 'method'
             )));

        $observer->attach($subscriber);
    }

    public function testRegistersSubscriptionsFromSubscriber()
    {
        $observer = new Palomar\EventDispatcher;
        $subscriber = $this->getMock('Palomar\AbstractSubscriber');
        
        $subscriber->expects($this->once())
             ->method('getSubscriptions')
             ->will($this->returnValue(array(
                'user.login' => 'method'
             )));

        $observer->attach($subscriber);
        $this->assertCount(1, $observer->getSubscriptions());
    }

    public function testSubscriberGetsNotified()
    {
        $observer = new Palomar\EventDispatcher;
        $subscriber = $this->getMock('Palomar\AbstractSubscriber');
        
        $subscriber->expects($this->once())
             ->method('getSubscriptions')
             ->will($this->returnValue(array(
                'user.login' => 'method'
             )));

         $subscriber->expects($this->once())
              ->method('notify');

        $observer->attach($subscriber);
        $observer->notify('user.login');
    }

    public function testSubscriberGetsArguments()
    {
        $observer = new Palomar\EventDispatcher;
        $subscriber = $this->getMock('Palomar\AbstractSubscriber');
        
        $subscriber->expects($this->once())
             ->method('getSubscriptions')
             ->will($this->returnValue(array(
                'user.login' => 'method'
             )));

         $subscriber->expects($this->once())
              ->method('notify')
              ->with('user.login', array(1, 'wkjagt@gmail.com'));

        $observer->attach($subscriber);
        $observer->notify('user.login', array(1, 'wkjagt@gmail.com'));
    }

    public function testSubscriberNotCalled()
    {
        $observer = new Palomar\EventDispatcher;
        $subscriber = $this->getMock('Palomar\AbstractSubscriber');
        
        $subscriber->expects($this->once())
             ->method('getSubscriptions')
             ->will($this->returnValue(array(
                'user.login' => 'method'
             )));

         $subscriber->expects($this->never())
              ->method('notify');

        $observer->attach($subscriber);
        $observer->notify('user.loginfail', array(1, 'wkjagt@gmail.com'));
    }


}