<?php

namespace App\Entity;

class Customer
{
    public const TYPES = [
        self::NEW,
        self::REGULAR,
        self::MERCHANT,
    ];

    public const MERCHANT = 'MERCHANT';
    public const REGULAR = 'REGULAR';
    public const NEW = 'NEW';

    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string
     */
    private string $lastName;

    /**
     * @var bool
     */
    private bool $isActive;

    /**
     * @var string
     */
    private string $type;

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param bool $isActive
     * @param string $type
     */
    public function __construct(int $id, string $firstName, string $lastName, bool $isActive, string $type)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->isActive = $isActive;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}