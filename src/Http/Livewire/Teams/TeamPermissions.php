<?php

namespace Elshaden\LivewireUsersystem\Http\Livewire\Teams;


use Elshaden\LivewireUsersystem\Models\Umteam;
use Elshaden\LivewireUsersystem\Tasks\Permissions\GetAllRolesTask;
use Elshaden\LivewireUsersystem\Tasks\Teams\CreateUpdateTeamTask;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TeamPermissions extends ModalComponent
{
  //  use LivewireAlert;

    public $TeamPermissions = [];

    public $Teams = [];
    public $name;
    public $role_id;
    public $translation_ar;
    public $translation_en;
    public $Options = [];
    public $AddNew = false;
    public $Parnets = [];
    public $TeamId = Null;
    protected $listeners = ['RefreshPermissions'=>'TeamPermissions']  ;
    public function mount($Team_id)
    {
         $this->TeamId = $Team_id;
        $this->TeamPermissions();


    }

    public function TeamPermissions()
    {
     //   $this->TeamPermissions = app(GetAllGroupedPermissionsTask::class)->byTeam($this->TeamId)->run();
        $this->TeamPermissions = Umteam::with('permissions')->find($this->TeamId)->permissions->sortBy('permissionsdisplays_id');
    //    $this->TeamPermissions = collect($TeamPermissions)->sortBy('permissionsdisplays_id')  ;
        $ok ='ok';
    }

    public function AddNewRecord()
    {
        $Roles = app(GetAllRolesTask::class)->run()->pluck('display_name', 'id');
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


        return view('livewire-usersystem::teams.team-permissions'

        );
    }

    public static function modalMaxWidth(): string
    {
        return 'md md:max-w-xl lg:max-w-3xl xl:max-w-6xl';
    }
}
