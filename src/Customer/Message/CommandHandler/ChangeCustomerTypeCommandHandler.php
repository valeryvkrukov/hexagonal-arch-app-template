<?php

namespace App\Customer\Message\CommandHandler;

use App\Customer\Message\Command\ChangeCustomerTypeCommand;
use App\Customer\Message\Response\CustomerResponse;
use App\Customer\Repository\CustomerRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ChangeCustomerTypeCommandHandler implements MessageHandlerInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $repository;

    /**
     * @param CustomerRepositoryInterface $repository
     */
    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ChangeCustomerTypeCommand $command
     * @return CustomerResponse
     */
    public function __invoke(ChangeCustomerTypeCommand $command): CustomerResponse
    {
        $customer = $this->repository->findById($command->getId());

        if (!$customer) {
            throw new \RuntimeException('Customer with id ' . $command->getId() . ' not exist.');
        }

        $customer->setType($customer->getType());

        return new CustomerResponse($customer);
    }
}