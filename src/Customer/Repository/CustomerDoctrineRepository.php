<?php

namespace App\Customer\Repository;

use App\Entity\Customer;

class CustomerDoctrineRepository implements CustomerRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Customer
    {
        foreach ($this->getFakeEntities() as $customer) {
            if ($customer->getId() === $id) {
                return $customer;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function getAll(?string $firstName, ?string $lastName): array
    {
        $entities = $this->getFakeEntities();

        if (!$firstName && !$lastName) {
            return $entities;
        }

        $filteredEntities = [];
        foreach ($entities as $entity) {
            if ($firstName && str_starts_with($entity->getFirstName(), $firstName)) {
                $filteredEntities[$entity->getId()] = $entity;
                continue;
            }

            if ($lastName && str_starts_with($entity->getLastName(), $lastName)) {
                $filteredEntities[$entity->getId()] = $entity;
            }
        }

        return $filteredEntities;
    }

    /**
     * @inheritDoc
     */
    public function getTotal(): int
    {
        return count($this->getFakeEntities());
    }

    /**
     * @return Customer[]
     */
    private function getFakeEntities(): array
    {
        $customers = [
            ['id' => 1, 'firstName' => 'John', 'lastName' => 'Wayne', 'isActive' => true, 'type' => 'new'],
            ['id' => 2, 'firstName' => 'Jane', 'lastName' => 'Wilford', 'isActive' => true, 'type' => 'regular'],
            ['id' => 3, 'firstName' => 'Jacob', 'lastName' => 'Wonka', 'isActive' => true, 'type' => 'merchant'],
            ['id' => 4, 'firstName' => 'Jennifer', 'lastName' => 'Walton', 'isActive' => true, 'type' => 'regular'],
            ['id' => 5, 'firstName' => 'Jack', 'lastName' => 'Wayne', 'isActive' => true, 'type' => 'new'],
        ];
        $entities = [];

        foreach ($customers as $customer) {
            $entities[] = new Customer(
                $customer['id'],
                $customer['firstName'],
                $customer['lastName'],
                $customer['isActive'],
                $customer['type']
            );
        }

        return $entities;
    }
}