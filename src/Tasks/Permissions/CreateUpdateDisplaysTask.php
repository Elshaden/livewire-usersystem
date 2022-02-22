<?php

namespace Elshaden\LivewireUsersystem\Tasks\Permissions;

use Elshaden\LivewireUsersystem\Models\Display;
use Exception;

class CreateUpdateDisplaysTask
{


    public function run(array $data)
    {
        try {
            return Display::updateOrCreate(['name'=>$data['name'], 'parent'=>$data['parent']], $data);
        }
        catch (Exception $exception) {
            throw new Exception('Failed to Create Display ');
        }
    }
}
