<?php

namespace App\Customer\Repository;

use App\Entity\Customer;

interface CustomerRepositoryInterface
{
    /**
     * @param int $id
     * @return Customer|null
     */
    public function findById(int $id): ?Customer;

    /**
     * @param string|null $firstName
     * @param string|null $lastName
     * @return Customer[]
     */
    public function getAll(?string $firstName, ?string $lastName): array;

    /**
     * @return int
     */
    public function getTotal(): int;
}