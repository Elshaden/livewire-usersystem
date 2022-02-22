<?php

namespace Elshaden\LivewireUsersystem\Tasks\Permissions;


use Elshaden\LivewireUsersystem\Models\Permission;
use Exception;

class GetAllGroupedPermissionsTask
{

    public function run()
    {

        try {

            return Permission::with(['display', 'umteams'])->where('permissionsdisplays_id', '!=', Null)
                ->orderByDesc('permissionsdisplays_id');


        } catch (Exception $exception) {
            throw new Exception('No Permission Found');
        }

//        return $permission;
    }

    public function byTeam($team_id){

        return  $this->run()->where('permissionsdisplays_id',$team_id );

    }
}
