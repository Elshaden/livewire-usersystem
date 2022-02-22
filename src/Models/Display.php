<?php

namespace Elshaden\LivewireUsersystem\Models;

use Illuminate\Database\Eloquent\Model   ;

class Display extends Model
{
    protected $table = 'permissionsdisplays';

    protected $fillable = [
        'name',
        'parent',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
   //  protected $with=['parent']  ;
    public function parent(){

        return $this->belongsTo(Display::class, 'parent', 'id');


    }

    public function permissions(){

        return $this->hasMany(Umpermission::class, 'id', 'permissionsdisplays_id');


    }

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Display';
}
