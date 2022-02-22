<?php

namespace Elshaden\LivewireUsersystem\Tasks\Permissions;

use Spatie\Permission\Models\Role;

class GetAllRolesTask
{
       public function run(){
         return  Role::all();
       }
}
