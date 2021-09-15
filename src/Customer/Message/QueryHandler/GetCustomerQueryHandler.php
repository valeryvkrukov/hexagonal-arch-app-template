<?php

namespace App\Customer\Message\QueryHandler;

use App\Customer\Message\Query\GetCustomerQuery;
use App\Customer\Message\Response\CustomerResponse;
use App\Customer\Repository\CustomerRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetCustomerQueryHandler implements MessageHandlerInterface
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
     * @param GetCustomerQuery $query
     * @return CustomerResponse
     */
    public function __invoke(GetCustomerQuery $query): CustomerResponse
    {
        $customer = $this->repository->findById($query->getId());

        if (!$customer) {
            throw new \RuntimeException('Customer with id ' . $query->getId() . ' not exists.');
        }

        return new CustomerResponse($customer);
    }
}