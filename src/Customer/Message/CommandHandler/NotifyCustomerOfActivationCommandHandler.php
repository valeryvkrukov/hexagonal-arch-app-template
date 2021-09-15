<?php

namespace App\Customer\Message\CommandHandler;

use App\Customer\Message\Command\NotifyCustomerOfActivationCommand;
use App\Customer\Repository\CustomerRepositoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class NotifyCustomerOfActivationCommandHandler implements MessageHandlerInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $repository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param CustomerRepositoryInterface $repository
     * @param LoggerInterface $logger
     */
    public function __construct(
        CustomerRepositoryInterface $repository,
        LoggerInterface $logger
    ) {
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @param NotifyCustomerOfActivationCommand $command
     */
    public function __invoke(NotifyCustomerOfActivationCommand $command): void
    {
        $customer = $this->repository->findById($command->getId());

        if (!$customer) {
            throw new \RuntimeException('Customer with id ' . $command->getId() . ' not exist.');
        }

        $this->logger->info('Customer activated. Sending notification now.');
    }
}