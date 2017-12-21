<?php

namespace App\Facades;

use App\Contracts\EntrustInterface;
use Illuminate\Support\Facades\Facade;

class EntrustFacade extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return EntrustInterface::class;
    }
}
