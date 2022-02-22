<?php

namespace Elshaden\LivewireUsersystem\Http\Livewire\Teams;


use Elshaden\LivewireUsersystem\Models\Display;
use Elshaden\LivewireUsersystem\Models\Permission;
use Elshaden\LivewireUsersystem\Models\Umteam;
use LivewireUI\Modal\ModalComponent;

class ManageTeamPermissions extends ModalComponent
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
    public $Groups = [];
    public $SelectGroup = Null;
    public $ListGroup = [];
    public $SelectedParent = Null;
    public $ShowSelectGroup = false;
    public $ShowTable = false;
    public $SelectedCheckbox = [];
    public $ExistingPermissions = [];
    protected $listeners = ['RefreshPermissions' => '$refresh'];

    public function mount($Team_id)
    {
        $this->TeamId = $Team_id;
//        $this->TeamPermissions();
        $this->Groups = Display::get();

    }

    public function updatedSelectGroup($value)
    {


        $this->ListGroup = $this->Groups->where('parent', $value)->toArray();
        $this->ShowSelectGroup = true;
    }

    public function TeamPermissions()
    {

        $TeamPermissionsIds = Umteam::with('permissions')->find($this->TeamId)?->permissions->pluck('id')->toArray() ?? [];//app(GetAllGroupedPermissionsTask::class)->byTeam($this->TeamId)->run();

        $this->PermissionsList = Permission::where('permissionsdisplays_id', $this->SelectedParent)->get();

        $SelectedCheckbox = array_fill_keys($TeamPermissionsIds, true);


        $this->SelectedCheckbox = $SelectedCheckbox;
        $this->ShowTable = true;
    }

    public function GiveAllParentPermissions(){

        $PermissionsList = Permission::where('permissionsdisplays_id', '!=', Null)->pluck('name', 'id');

        $this->SelectedCheckbox = $PermissionsList->map(function ($value, $key){
            return true;
        })->toArray();
         $this->SyncThePermissions();
    }
    public function RevokeAllParentPermissions(){

        $PermissionsList = Permission::where('permissionsdisplays_id', '!=', Null)->pluck('name', 'id');

        $this->SelectedCheckbox = $PermissionsList->map(function ($value, $key){
            return false;
        })->toArray();
        $this->SyncThePermissions();
    }
    public function SyncThePermissions()
    {

        $Pers = $this->SelectedCheckbox;

       $Team = Umteam::find($this->TeamId);
        foreach ($Pers as $key => $val) {
            if ($val) $Team->permissions()->syncWithoutDetaching($key);

            if (!$val) $Team->permissions()->detach($key);

        }
    //    $this->emit('RefreshPermissions');
        $this->closeModal();

    }




    public function render()
    {


        return view('livewire-usersystem::teams.manage-team-permissions'

        );
    }

    public static function modalMaxWidth(): string
    {
        return 'md md:max-w-xl lg:max-w-3xl xl:max-w-6xl';
    }
}
