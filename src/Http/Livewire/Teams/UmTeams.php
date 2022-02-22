<?php

namespace Elshaden\LivewireUsersystem\Http\Livewire\UI\WEB\Livewire\Teams;

use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;
use Elshaden\LivewireUsersystem\Http\Livewire\Models\Umteam;
use Elshaden\LivewireUsersystem\Http\Livewire\Tasks\Teams\CreateUpdateTeamTask;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UmTeams extends Component
{
    use LivewireAlert;

    public $Roles = [];

    public $Teams = [];
    public $name;
    public $role_id;
    public $translation_ar;
    public $translation_en;
    public $Options = [];
    public $AddNew = false;
    public $Parnets = [];
    public $PermissionCount=Null;

    protected $listeners = ['RefreshPermissions'=>'$refresh']  ;

    public function mount()
    {

        $this->GetTeams();


    }

    public function GetTeams()
    {
        $this->Teams = Umteam::with('permissions')->get();

    }

    public function AddNewRecord()
    {
        $Roles = app(GetAllRolesTask::class)->run(true)->pluck('display_name', 'id');
        $this->Roles = $Roles->reject(function ($value, $key) {
            return $value == 'master';
        });


        $this->AddNew = true;

    }

    public function Save()
    {
        $Data = $this->validate([
            'name' => 'required',
            'role_id' => 'required',
            'translation_ar' => '',
            'translation_en' => '',
        ]);
       $data = [
           'name' => $Data['name'],
           'role_id' =>  $Data['role_id'],
           'translation' => ['ar'=>$Data['translation_ar'], 'en'=>$Data['translation_en']],

       ] ;
        app(CreateUpdateTeamTask::class)->run($data);
        $this->GetTeams();

        $this->AddNew = false;
    }


    public function render()
    {


        return view('livewire-usersystem::teams.umteams'

        );
    }
}
