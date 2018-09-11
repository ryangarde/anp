<?php

namespace App\Repositories;

use App\Contracts\OrderInterface;


class ReportRepository extends Repository
{
    protected $order;

    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

}
