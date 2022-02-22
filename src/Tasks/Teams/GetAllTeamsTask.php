<?php

namespace Elshaden\LivewireUsersystem\Tasks\Teams;

use App\Containers\AppSection\User\Models\User;
use App\Containers\Vendor\UserMgt\Data\Repositories\DisplayRepository;
use App\Containers\Vendor\UserMgt\Data\Repositories\UmteamRepository;
use App\Ship\Criterias\IsNullCriteria;
use App\Ship\Criterias\ThisEqualThatCriteria;
use App\Ship\Exceptions\CreateResourceFailedException;
use Elshaden\LivewireUsersystem\Models\Umteam;
use Exception;

class GetAllTeamsTask
{


    public function run()
    {
        try {
            return Umteam::all();
        }
        catch (Exception $exception) {
            throw new Exception('No Teams Found');
        }
    }

    public function userRole(User $user){

        $Roles = $user->roles->pluck('id');
        $Teams = Umteam::whereIn('role_id' ,$Roles)->where('personal_team', 0)->all();

       return $Teams;
    }


}
