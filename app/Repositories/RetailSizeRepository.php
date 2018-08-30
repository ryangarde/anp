<?php

namespace App\Repositories;

use App\RetailSize;
use App\Contracts\RetailSizeInterface;

class RetailSizeRepository extends Repository implements RetailSizeInterface
{
    /**
     * Create new instance of retail size repository.
     *
     * @param Category $retailSize RetailSize repository.
     */
    public function __construct(RetailSize $retailSize)
    {
        parent::__construct($retailSize);
        $this->retailSize = $retailSize;
    }
}
