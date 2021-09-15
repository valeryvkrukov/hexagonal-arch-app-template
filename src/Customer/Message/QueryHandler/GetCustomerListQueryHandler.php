<?php

namespace App\Customer\Message\QueryHandler;

use App\Customer\Message\Query\GetCustomerListQuery;
use App\Customer\Message\Response\CustomerListResponse;
use App\Customer\Repository\CustomerRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetCustomerListQueryHandler implements MessageHandlerInterface
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
     * @param GetCustomerListQuery $query
     * @return CustomerListResponse
     */
    public function __invoke(GetCustomerListQuery $query): CustomerListResponse
    {
        $customers = $this->repository->getAll(
            $query->getFilters()->getFirstName(),
            $query->getFilters()->getLastName()
        );
        $total = $this->repository->getTotal();

        return new CustomerListResponse($customers, $total);
    }
}