<?php

namespace App\Customer\Message\Response;

use App\Entity\Customer;

final class CustomerListResponse
{
    /**
     * @var CustomerResponse[]
     */
    private array $customers = [];

    /**
     * @var int
     */
    private int $total;

    /**
     * @param Customer[] $customers
     * @param int $total
     */
    public function __construct(array $customers, int $total)
    {
        $this->total = $total;

        foreach ($customers as $customer) {
            $this->customers[] = new CustomerResponse($customer);
        }
    }

    /**
     * @return CustomerResponse[]
     */
    public function getCustomers(): array
    {
        return $this->customers;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}