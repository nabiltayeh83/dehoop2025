<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;

class HasPermission
{

    public function handle($request, Closure $next)
    {

        if(auth()->guard('admin')->user()->status == 'not_active'){
            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        }


        $route_name = Request::route()->getName();

         if(auth()->guard('admin')->user()->id == 1){
            return $next($request);
        }

        if($route_name == 'homePage'){
            return $next($request);
        }


        $checkPermission = Permission::where('route_name', $route_name)->first();

        if(!$checkPermission){
            return $next($request);
        }
        
        



        if(isset(auth()->guard('admin')->user()->role_id)) {
            $rolePermissionsIDs = RolePermission::where('role_id', auth()->guard('admin')->user()->role_id)->pluck('permission_id')->toArray();
            $roleParentsPermissionsIDs = Permission::whereIn('id', $rolePermissionsIDs)->pluck('parent_id')->toArray();
        }
        
        
        if(in_array($checkPermission->id, $rolePermissionsIDs)){
            return $next($request);
        }
        
        
        if(in_array($checkPermission->id, $roleParentsPermissionsIDs)){
            return $next($request);
        }
        
 

        return redirect()->route('admin.admin.home');

    }
}


