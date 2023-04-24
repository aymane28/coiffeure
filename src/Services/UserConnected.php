<?php

namespace App\Services;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserConnected
{
    protected $security;

    public function __construct(Security $security)
    {
        $this->security=$security;
    }

    public function getUserConnected(){
        return $this->security->getUser();
    }
}