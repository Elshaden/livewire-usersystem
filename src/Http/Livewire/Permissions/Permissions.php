<?php

namespace Elshaden\LivewireUsersystem\Http\Livewire\Permissions;


use Elshaden\LivewireUsersystem\Tasks\Permissions\CreatePermissionTask;
use Elshaden\LivewireUsersystem\Tasks\Permissions\GetAllDisplaysTask;

use Elshaden\LivewireUsersystem\Tasks\Permissions\GetAllGroupedPermissionsTask  ;
use Livewire\Component;

class Permissions extends Component
{
//    use LivewireAlert;

    public $Displays = [];

    public $Permissions = [];
    public $name;
    public $description;
    public $display_name;
    public $permissionsdisplays_id;
    public $translation_ar;
    public $translation_en;
    public $Options = [];
    public $AddNew = false;
    public $Parnets = [];


    public function mount()
    {

        $this->GetPermissioins();


    }

    public function GetPermissioins()
    {
        $this->Permissions =app(GetAllGroupedPermissionsTask::class)->run()->toArray();
    }

    public function AddNewRecord()
    {
        $Displays = app(GetAllDisplaysTask::class)->grouped()->pluck('name', 'id');
        $this->Displays =$Displays;


        $this->AddNew = true;

    }

    public function Save()
    {
        $Data = $this->validate([
            'name' => 'required|unique:permissions,name',
            'permissionsdisplays_id'=>'required',
            'description' => '',
//            'display_name'=>'',
            'translation_ar' => '',
            'translation_en' => '',
        ]);

        $Data['translation'] = ['ar'=>$Data['translation_ar'], 'en'=>$Data['translation_en']];
        $Data['display_name'] = $Data['translation']['ar'];
        unset($Data['translation_ar'],$Data['translation_en'])  ;


        app(CreatePermissionTask::class)->run(
             $Data['name'],  $Data['description'] ,  $Data['display_name'],$Data['permissionsdisplays_id'] , $Data['translation']

        );
        $this->GetPermissioins();

        $this->AddNew = false;
    }


    public function render()
    {


        return view('livewire-usersystem::permissions.umpermissions'

        );
    }
}
