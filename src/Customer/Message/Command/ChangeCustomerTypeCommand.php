<?php

namespace App\Customer\Message\Command;

use App\Entity\Customer;
use Symfony\Component\Validator\Constraints as Assert;
use Fusonic\HttpKernelExtensions\Attribute\FromRequest;

#[FromRequest]
final class ChangeCustomerTypeCommand
{
    /**
     * @var int
     */
    #[Assert\NotNull(message: "Id should not be null.")]
    #[Assert\Positive(message: "Id should be a positive integer.")]
    private int $id;

    /**
     * @var string
     */
    #[Assert\NotNull(message: "Type should not be null.")]
    #[Assert\Choice(
        choices: Customer::TYPES,
        message: "Customer type should match one of existing types."
    )]
    private string $type;

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