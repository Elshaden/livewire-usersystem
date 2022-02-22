<?php

namespace Elshaden\LivewireUsersystem\Models;

use Illuminate\Database\Eloquent\Model   ;

class Umteam extends Model
{
    protected $fillable = [
        'role_id',
        'name',
        'personal_team',
        'user_id',
        'translation',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'translation'=>'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'permission_team', 'umteam_id', 'permission_id')   ;
    }


    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Umteam';
}
