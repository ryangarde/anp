<?php

namespace App\Repositories;

use App\User;
use App\Contracts\UserInterface;

class UserRepository extends Repository implements UserInterface
{
    /**
     * Create new instance of project repository.
     *
     * @param User $user User repository.
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }
}
