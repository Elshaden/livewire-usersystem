<?php

namespace Elshaden\LivewireUsersystem\Http\Livewire\UI\WEB\Livewire\Users;

use Elshaden\LivewireUsersystem\Tasks\Teams\GetAllTeamsTask;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class UserTeams extends ModalComponent
{
  //  use LivewireAlert;

    public $UserTeams = [];

    public $Teams = [];
    public $name;
    public $team_id;
    public $translation_ar;
    public $translation_en;
    public $Options = [];
    public $AddNew = false;
    public $Parnets = [];
    public $UserId = Null;
    public  $User ;
    public $AllTeams =[];

    public function mount($User_id)
    {
         $this->UserId = $User_id;
        $this->GetUserTeams();


    }

    public function GetUserTeams()
    {
        $this->User =  User::with(['umteams','roles'])->Find($this->UserId) ;//app(GetAllGroupedPermissionsTask::class)->byTeam($this->TeamId)->run();
        $this->UserTeams = $this->User->umteams;

        $ok ='ok';
    }

    public function AddNewTeam()
    {
        $AllTeams = app(GetAllTeamsTask::class)->userRole($this->User)->pluck('translation', 'id');
        $arrayTeams = $this->UserTeams->pluck('id')->toArray();
         $this->AllTeams = $AllTeams->reject(function ($value, $key) use($arrayTeams){

              return in_array($key, $arrayTeams)  ;
         }) ;


        $this->AddNew = true;

    }

    public function Save()
    {
        $Data = $this->validate([
            'team_id' => 'required',

        ]);

       $this->User->umteams()->attach($Data['team_id'])  ;
        $this->GetUserTeams();

        $this->AddNew = false;
    }

    public function Revoke($team_id)
    {

        $this->User->umteams()->detach($team_id)  ;
        $this->GetUserTeams();


    }

    public function render()
    {


        return view('livewire-usersystem::users.user-teams'

        );
    }

    public static function modalMaxWidth(): string
    {
        return 'md md:max-w-xl lg:max-w-3xl xl:max-w-6xl';
    }
}
