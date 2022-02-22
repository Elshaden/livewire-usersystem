<?php

namespace Elshaden\LivewireUsersystem\Traits;


use Elshaden\LivewireUsersystem\Models\Umteam;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait InteractsWithUserMgt
{


    public function umteams() :BelongsToMany
    {

        return $this->belongsToMany(Umteam::class) ;
    }

    public function teampermissions(){

        return  $this->belongsToMany(Umteam::class) ->with('permissions') ;

    }

}
