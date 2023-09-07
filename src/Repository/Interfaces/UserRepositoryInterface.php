<?php

namespace App\Repository\Interfaces;

use App\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return User
     */
    public function getUser(int $userId): User;
}