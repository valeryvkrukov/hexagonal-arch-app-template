<?php

namespace App\Customer\Message\EventHandler;

use App\Customer\Message\Command\NotifyCustomerOfActivationCommand;
use App\Customer\Message\Event\CustomerActivatedEvent;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class CustomerActivatedEventHandler implements MessageHandlerInterface
{
    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $messageBus;

    /**
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param CustomerActivatedEvent $event
     */
    public function __invoke(CustomerActivatedEvent $event): void
    {
        $command = new NotifyCustomerOfActivationCommand($event->getId());
        $this->messageBus->dispatch(new Envelope($command));
    }
}