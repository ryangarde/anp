<?php

namespace App\Repositories;

use App\Admin;
use App\Contracts\AdminInterface;

class AdminRepository extends Repository implements AdminInterface
{
    /**
     * Create new instance of admin repository.
     *
     * @param Admin $admin Admin repository.
     */
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
        $this->admin = $admin;
    }
}
