<?php

namespace App\Repositories;

use App\Contracts\ProducerInterface;
use App\Producer;

class ProducerRepository extends Repository implements ProducerInterface
{
    /**
     * Create new instance of producer repository.
     *
     * @param Producer $producer Producer repository.
     */
    public function __construct(Producer $producer)
    {
        parent::__construct($producer);
        $this->producer = $producer;
    }
}
