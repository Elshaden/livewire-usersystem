<?php

namespace Elshaden\LivewireUsersystem\Tasks\Permissions;

use App\Containers\Vendor\UserMgt\Data\Repositories\DisplayRepository;
use App\Containers\Vendor\UserMgt\Data\Repositories\UserMgtRepository;
use App\Ship\Criterias\NotNullCriteria;
use App\Ship\Criterias\OrderByFieldCriteria;
use Elshaden\LivewireUsersystem\Models\Display;


class GetAllDisplaysTask
{


    public function run()
    {
        return Display::with(['parent'])->all();
    }

    public function grouped(){

        $Display = Display::with(['parent'])->where('parent', '!=',Null)->orderByDesc('parent')->all() ;

        return $Display;

    }
}
