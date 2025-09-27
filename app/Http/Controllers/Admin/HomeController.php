<?php

namespace App\Http\Controllers\Admin;

use App\Admin;


use App\Models\User;
use App\Models\Permission;
use App\Models\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class HomeController extends Controller
{
    
    public function index()
    {   
        
        $thisResponse = (object)[
            // 'goals' => Goal::latest('id')->take(8)->get(),
            // 'goalsCount' => Goal::count(),
            // 'tasks' => Task::latest('id')->take(6)->get(),
            // 'opportunities' => Opportunity::latest('id')->take(5)->get(),
            // 'contact' => Contact::latest('id')->take(5)->get(),
            // 'feedbacks' => Feedback::where('rate', '>', 0)->latest('id')->take(4)->get(),
            // 'projects' => Project::latest('id')->take(5)->get(),
            // 'ministries_ideas' => MinistryIdea::latest('id')->take(4)->get(),
        ];
        
        return view('admin.home.dashboard', ['data' => $thisResponse]);
        
    }
    


    public function changeStatus($model,Request $request)
    {
        $role = "";
        
        if($model == "admins"){
            $role = "App\Admin";
        }
        elseif($model == "Driver" || $model == "Accountant"){
            $role = "App\Models\User";
        }
        else{
            $role = "App\Models\\$model";
        }
        
        
        if($role !=""){
             if ($request->action == 'delete') {
                $role::query()->whereIn('id', $request->IDsArray)->delete();
            }
            else {
                if($request->action) {
                    $role::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->action]);
                }
            }

            return $request->action;
        }
        return false;
        
  
    }
 

    public function getCities($id){
        return City::where(['country_id' => $id, 'status' => 'active'])->get();
    }

    public function getCountries(){
        return Country::where(['status' => 'active'])->get();
    }


 
}
