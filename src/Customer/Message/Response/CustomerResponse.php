<?php

namespace App\Customer\Message\Response;

use App\Entity\Customer;

final class CustomerResponse
{
    /**
     * @var Customer
     */
    private Customer $entity;

    /**
     * @param Customer $entity
     */
    public function __construct(Customer $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->entity->getId();
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->entity->getFirstName();
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->entity->getLastName();
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->entity->isActive();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->entity->getType();
    }
}