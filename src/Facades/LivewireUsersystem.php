<?php

namespace Elshaden\LivewireUsersystem\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Elshaden\LivewireUsersystem\LivewireUsersystem
 */
class LivewireUsersystem extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'livewire-usersystem';
    }
}
