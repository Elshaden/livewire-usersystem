<?php

namespace Elshaden\LivewireUsersystem\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission  extends SpatiePermission
{



    public function display(){

        return $this->belongsTo(Display::class, 'permissionsdisplays_id', 'id')  ;
    }

    public function umteams(){
        return $this->belongsToMany(Umteam::class, 'permission_team', 'umteam_id', 'permission_id')   ;

    }

}
