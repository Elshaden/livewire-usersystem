<?php

namespace Elshaden\LivewireUsersystem\Tasks\Teams;

use App\Containers\Vendor\UserMgt\Data\Repositories\DisplayRepository;
use App\Containers\Vendor\UserMgt\Data\Repositories\UmteamRepository;
use App\Ship\Exceptions\CreateResourceFailedException;

use Elshaden\LivewireUsersystem\Models\Umteam;
use Exception;

class CreateUpdateTeamTask
{


    public function run(array $data)
    {
        try {
            return Umteam::updateOrCreate(['name'=>$data['name'], 'role_id'=>$data['role_id']], $data);
        }
        catch (Exception $exception) {
            throw new Exception('Failed to Create Team ');
        }
    }
}
