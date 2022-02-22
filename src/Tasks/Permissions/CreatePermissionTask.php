<?php

namespace Elshaden\LivewireUsersystem\Tasks\Permissions;


use Elshaden\LivewireUsersystem\Models\Permission;
use Exception;

class CreatePermissionTask
{


    public function run(string $name, string $description = null, string $displayName = null,$permissionsdisplays_id = null ,array  $translation = Null): Permission
    {
        app()['cache']->forget('spatie.permission.cache');

        try {
            $permission =       Permission::create([
                'name' => $name,
                'description' => $description,
                'display_name' => $displayName,
                'guard_name' => 'web',
                'permissionsdisplays_id'=>$permissionsdisplays_id,
                'translation'=>$translation

            ]);
        } catch (Exception $exception) {
            throw new Exception('Failed to Create Permission');
        }

        return $permission;
    }
}
