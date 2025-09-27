<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\Language;
use App\Models\Role as TargetModel;
use App\Models\Permission;
use App\Models\RolePermission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    
    public function __construct()
    {
        $this->baseFolder = 'admin.roles';
        $this->indexRoute = 'admin.Role.index';
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share(['locales' => $this->locales, 'settings' => $this->settings]);
    }


    public function index(Request $request)
    {

        $thisResponse = (object)[
            'items' => TargetModel::query()->paginate(20),
        ];
        
        return view($this->baseFolder . '.home', ['data' => $thisResponse]);
    }


    public function create()
    {

        $thisResponse = (object)[
            'permissions' => Permission::get(),
        ];
        
        return view($this->baseFolder . '.create', ['data' => $thisResponse]);
    }



    public function store(Request $request)
    {
        
        $item = New TargetModel();
        $item->name = $request->name;
        $item->save();
        
        if(count($request->permissions) > 0){
            foreach($request->permissions as $one){
                $roles_permissions = new RolePermission();
                $roles_permissions->role_id = $item->id;
                $roles_permissions->permission_id = $one;
                $roles_permissions->save();
            }
        }
        
        return redirect()->route($this->indexRoute)->with('status', __('translate.createdSucc'));
    }
    

    

    public function edit($id)
    {

        $thisResponse = (object)[
            'item' => TargetModel::findOrFail($id),
            'permissions' => Permission::orderBy('reorder_by', 'asc')->get(),
        ];
        
        return view($this->baseFolder . '.edit', ['data' => $thisResponse]);
    }
    

    
    public function update(Request $request, $id)
    {

        $item = TargetModel::findOrFail($id);
        $item->name = $request->name;
        $item->save();
        
        RolePermission::where('role_id', $id)->delete();
        
        if(count($request->permissions) > 0){
            foreach($request->permissions as $one){
                $roles_permissions = new RolePermission();
                $roles_permissions->role_id = $item->id;
                $roles_permissions->permission_id = $one;
                $roles_permissions->save();
            }
        }
          
        return redirect()->route($this->indexRoute)->with('status', __('translate.updatedSucc'));

    }
    
    

    public function destroy($id){
        $item = TargetModel::query()->findOrFail($id)->delete();
        
        // if($item->hasTranslation == 1){
        //     $item->deleteTranslations();    
        // }
        
        // $item->delete();
    }


}
