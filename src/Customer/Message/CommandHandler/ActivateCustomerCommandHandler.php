<?php

namespace App\Customer\Message\CommandHandler;

use App\Customer\Message\Command\ActivateCustomerCommand;
use App\Customer\Message\Event\CustomerActivatedEvent;
use App\Customer\Message\Response\CustomerResponse;
use App\Customer\Repository\CustomerRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class ActivateCustomerCommandHandler implements MessageHandlerInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $repository;
    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $messageBus;

    /**
     * @param CustomerRepositoryInterface $repository
     * @param MessageBusInterface $messageBus
     */
    public function __construct(
        CustomerRepositoryInterface $repository,
        MessageBusInterface $messageBus
    ) {
        $this->repository = $repository;
        $this->messageBus = $messageBus;
    }

    /**
     * @param ActivateCustomerCommand $command
     * @return CustomerResponse
     */
    public function __invoke(ActivateCustomerCommand $command): CustomerResponse
    {
        $customer = $this->repository->findById($command->getId());

        if (!$customer) {
            throw new \RuntimeException('Customer with id ' . $command->getId() . ' not exists.');
        }

        $customer->setIsActive(true);
        $event = new CustomerActivatedEvent($customer->getId());
        $this->messageBus->dispatch($event)->with(new DispatchAfterCurrentBusStamp());

        return new CustomerResponse($customer);
    }
}