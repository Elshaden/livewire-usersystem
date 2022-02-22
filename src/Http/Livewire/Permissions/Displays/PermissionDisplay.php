<?php

namespace Elshaden\LivewireUsersystem\Http\Livewire\Permissions\Displays;

use Elshaden\LivewireUsersystem\Models\Display;
use Elshaden\LivewireUsersystem\Tasks\Permissions\CreateUpdateDisplaysTask;
use Livewire\Component;

class PermissionDisplay extends Component
{

  //  use LivewireAlert;
    public $Displays = [];


    public $name;
    public $parent;
    public $Options = [];
    public $AddNew = false;
    public $Parnets  = [];


    public function mount()
    {

        $this->Displays = Display::with('parent')->get()->toArray();




    }

    public function AddNewRecord(){
        $this->Parnets  = $this->Displays->where('parent',null)->pluck('name', 'id')?->toArray()??[];
        $this->AddNew = true;

    }

    public function Save()
    {
    $data =     $this->validate([
            'name' => 'required',
            'parent' => '',


        ]);

        app(CreateUpdateDisplaysTask::class)->run($data);
        $this->Displays = Display::get();;// = app(GetAllDisplaysTask::class)->run();

        $this->AddNew = false;
    }




    public function render()
    {


        return view('livewire-usersystem::permissions.permissions-display'

        );
    }

}
