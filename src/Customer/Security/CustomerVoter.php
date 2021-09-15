<?php

namespace App\Customer\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class CustomerVoter extends Voter
{
    public const LIST = 'LIST';
    public const VIEW = 'VIEW';
    public const ACTIVATE = 'ACTIVATE';
    public const DEACTIVATE = 'DEACTIVATE';
    public const CHANGE_ROLE = 'CHANGE_ROLE';

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports(string $attribute, $subject): bool
    {
        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        return true;
    }
}