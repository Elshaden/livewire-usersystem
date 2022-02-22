<?php

namespace Elshaden\LivewireUsersystem;

use Elshaden\LivewireUsersystem\Http\Livewire\Livewire\Users\UmUsers;

use Elshaden\LivewireUsersystem\Http\Livewire\Permissions\Displays\PermissionDisplay;
use Elshaden\LivewireUsersystem\Http\Livewire\Permissions\Permissions;
use Elshaden\LivewireUsersystem\Http\Livewire\Permissions\PermissionsTable;
use Elshaden\LivewireUsersystem\Http\Livewire\Teams\ManageTeamPermissions;
use Elshaden\LivewireUsersystem\Http\Livewire\Teams\TeamPermissions;
use Elshaden\LivewireUsersystem\Http\Livewire\UI\WEB\Livewire\Teams\UmTeams;
use Elshaden\LivewireUsersystem\Http\Livewire\UI\WEB\Livewire\Users\UserTeams;
use Elshaden\LivewireUsersystem\Models\Permission;
use Elshaden\LivewireUsersystem\resources\ViewComponents\Ummaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Elshaden\LivewireUsersystem\Commands\LivewireUsersystemCommand;

class LivewireUsersystemServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('livewire-usersystem')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations(['add_translatioin_to_permissions_table', 'create_user_mgts_table'])
            ->hasViewComponents('ummaster', Ummaster::class);
        //    ->hasCommand(LivewireUsersystemCommand::class);
    }
    public function registeringPackage()
    {
        Route::middleware(config('livewire-usersystem.route_middleware'))->prefix('umusers')->group(function () {

            Route::get('/users', function () {
                return view('livewire-usersystem::users.index');
            })->name('umusers.users');


            Route::get('/teams', function () {
                return view('livewire-usersystem::teams.index');
            }) ->name('umusers.teams');


            Route::get('/permissions', function () {
                return view('livewire-usersystem::permissions.permissions_index');
            })->name('umusers.permissions');


            Route::get('/displays', function () {
                return view('livewire-usersystem::permissions.index');
            })->name('umusers.displays');


        });

    }

    public function bootingPackage()
    {
        Livewire::component('um-users', UmUsers::class);
        Livewire::component('user-teams', UserTeams::class);

        Livewire::component('permission-display', PermissionDisplay::class);
        Livewire::component('um-teams', UmTeams::class);
        Livewire::component('um-permissions', Permissions::class);
        Livewire::component('team-permissions', TeamPermissions::class);
        Livewire::component('manage-team-permissions', ManageTeamPermissions::class);
        Livewire::component('permissions-table', PermissionsTable::class);



   //     Blade::component('ummaster', Ummaster::class);
        Blade::if('teamCan', function ($permissions){
            return $this->TeamCan($permissions) ;

        }) ;
    }
    private function TeamCan($permissions){
        if(!is_array($permissions)) $permissions = [$permissions];

        $permissionIds = Auth::user()->teampermissions;
        $related = [];
        foreach ($permissionIds as $tams){
            $relatedx =  $tams->permissions->pluck('id')->toArray();
            if($relatedx) $related = array_merge($related,$relatedx ) ;
        }

        foreach ($permissions as $permission){
            $Permission = Permission::findByName($permission)??Null;
            if($Permission && in_array($Permission->id, $related))  return true;
        }
        return false;
    }
}
