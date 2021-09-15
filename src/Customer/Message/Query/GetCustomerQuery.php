<?php

namespace App\Customer\Message\Query;

use Symfony\Component\Validator\Constraints as Assert;
use Fusonic\HttpKernelExtensions\Attribute\FromRequest;

#[FromRequest]
final class GetCustomerQuery
{
    /**
     * @var int
     */
    #[Assert\NotNull(message: "Id should not be null.")]
    #[Assert\Positive(message: "Id should be a positive integer.")]
    private int $id;

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
}