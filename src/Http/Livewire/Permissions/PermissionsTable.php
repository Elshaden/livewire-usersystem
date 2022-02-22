<?php

namespace Elshaden\LivewireUsersystem\Http\Livewire\Permissions;

use Elshaden\LivewireUsersystem\Models\Permission;
use Elshaden\LivewireUsersystem\Models\Umteam;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class PermissionsTable extends TableComponent
{
    public $table_class = 'table-hover table-striped';
    public $checkbox_side = 'left';
    public $footer_view ='livewire-usersystem::teams.save-teams';
     public $TeamId;


    public function mount($TeamId = Null){
        $this->setTableProperties();
        $this->TeamId = $TeamId;


    }


    public function query()
    {
        $ExistPermissions = Umteam::with('permissions')->find($this->TeamId)->permissions->pluck('id');

        foreach ($ExistPermissions as $exist){
            $this->checkbox_values[$exist] = true;

        }
        return Permission::with('display');

    }

    public function columns()
    {
        return [
            Column::make('الصلاحية', 'display_name')->searchable()->sortable(),
            Column::make('المجموعة', 'display.name')->searchable()->sortable(),
        ];
    }


    public function SaveTeamPermissions(){


    }
}
