<?php

namespace Elshaden\LivewireUsersystem\Http\Livewire\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UmUsers extends Component
{
    protected $Users  ;

    public function mount(){

        $Users = User::get();

        if(config('livewire-usersystem.exclude_roles')) {
            $Users = $Users->reject(function ($value, $key) {
                return $value->hasRole(config('livewire-usersystem.exclude_roles'));
            });
        }
        $this->Users = $Users->map(function ($value, $key) {
            $roles = $value->roles()->pluck('name')->toArray();
             $value['roles'] = implode(',', $roles) ;
            return $value;
        });



    }


    public function render()
    {


        return view('livewire-usersystem::users.umusers', ['Users'=>$this->Users]

        );
    }
}
