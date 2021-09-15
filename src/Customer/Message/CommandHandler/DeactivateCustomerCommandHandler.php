<?php

namespace App\Customer\Message\CommandHandler;

use App\Customer\Message\Command\ActivateCustomerCommand;
use App\Customer\Message\Response\CustomerResponse;
use App\Customer\Repository\CustomerRepositoryInterface;

final class DeactivateCustomerCommandHandler
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $repository;

    /**
     * @param CustomerRepositoryInterface $repository
     */
    public function __construct(CustomerRepositoryInterface $repository) {
        $this->repository = $repository;
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

        $customer->setIsActive(false);

        return new CustomerResponse($customer);
    }
}