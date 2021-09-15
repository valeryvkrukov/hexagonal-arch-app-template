<?php

namespace App\Customer\Message\Query;

use Fusonic\HttpKernelExtensions\Attribute\FromRequest;

#[FromRequest]
final class GetCustomerListQuery
{
    /**
     * @var CustomerFilter
     */
    private CustomerFilter $filters;

    /**
     * @param CustomerFilter|null $filters
     */
    public function __construct(?CustomerFilter $filters = null)
    {
        $this->filters = $filters ?? new CustomerFilter();
    }

    /**
     * @return CustomerFilter
     */
    public function getFilters(): CustomerFilter
    {
        return $this->filters;
    }

    /**
     * @param CustomerFilter $filters
     */
    public function setFilters(CustomerFilter $filters): void
    {
        $this->filters = $filters;
    }
}