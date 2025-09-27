<?php

namespace App\Providers;

use App\Admin;

use App\Models\Language;
use App\Models\Contact;

use Carbon\Carbon;

use App\User;
use App\Models\Setting;



use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Auth;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Paginator::useBootstrap();

        Schema::defaultStringLength(191);
        // Paginator::useBootstrap();

        view()->composer('*', function ($view) 
        {


            $adminPermissions = [];
            
            if(isset(auth()->guard('admin')->user()->role_id)) {
                if(auth()->guard('admin')->user()->id == 1){
                    $adminPermissions = Permission::where('in_sidebar', 1)->orderBy('reorder_by', 'asc')->get();
                }
                else{
                    $rolePermissionsIDs = RolePermission::where('role_id', auth()->guard('admin')->user()->role_id)->pluck('permission_id')->toArray();

                    if (count($rolePermissionsIDs) > 0) {
                        
                        $roleParentsPermissionsIDs = Permission::whereIn('id', $rolePermissionsIDs)->pluck('parent_id')->toArray();
                        $adminPermissions = Permission::whereIn('id', $roleParentsPermissionsIDs)->where('in_sidebar', 1)->orderBy('reorder_by', 'asc')->get();
                    }    
                }
                
            }



            $view->with([
                'setting' => Setting::query()->first(),
                'newContactMsg' => Contact::query()->where('seen', 0)->count(),
                'adminPermissions' => $adminPermissions,
            ]);
            
        });
    }



    public function register()
    {
        //
    }
}

