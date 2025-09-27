<?php

namespace App\Http\Controllers\Admin;

use App\Models\User as TargetModel;

use Carbon\Carbon;

use Dotenv\Exception\ValidationException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostNotification;
use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{


    public function __construct()
    {
        $this->baseFolder = 'admin.users';
        $this->indexRoute = 'admin.User.index';
    }



    public function index(Request $request)
    {
        
        $items = TargetModel::query();

        if ($request->txt) {
            if ($request->txt != null){
                $items->where('first_name', 'like', '%' . $request->txt . '%');
            }    
        }
 
        $thisResponse = (object)[
            'items' => $items->where('type', 'customer')->latest('id')->paginate(20),
        ];
        
        return view($this->baseFolder . '.home', ['data' => $thisResponse]);
    }



    public function create()
    {
        return view($this->baseFolder  . '.createEdit');
    }




    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = new TargetModel();
        $item->type = 'customer';
        $item->first_name = $request->first_name;
        $item->last_name = $request->last_name;
        $item->full_name = $request->first_name. ' ' . $request->last_name;
        $item->username = $request->username;
        $item->email = $request->email;
        $item->password = bcrypt($request->password);
        $item->address = $request->address;
        $item->mobile = $request->mobile;
        $item->save();
        
        return redirect()->route($this->indexRoute)->with('status', __('translate.createdSucc'));
    }



    public function edit($id)
    {
        
        $thisResponse = (object)[
            'item' => TargetModel::findOrFail($id),
        ];
        
        return view($this->baseFolder . '.createEdit', ['data' => $thisResponse]);
    }


    public function show($id)
    {
        
        $thisResponse = (object)[
            'item' =>  TargetModel::findOrFail($id),
        ];
         
        return view($this->baseFolder . '.show', ['data' => $thisResponse]);
    }


    public function update(Request $request, $id)
    {
        $item = TargetModel::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username'=>'required|unique:users,username,'.$id.',id,deleted_at,NULL',
            'email'=>'required|email|unique:users,email,'.$id.',id,deleted_at,NULL',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item->first_name = $request->first_name;
        $item->last_name = $request->last_name;
        $item->full_name = $request->first_name. ' ' . $request->last_name;
        $item->username = $request->username;
        $item->email = $request->email;
        $item->password = bcrypt($request->password);
        $item->address = $request->address;
        $item->mobile = $request->mobile;
        $item->save();


        return redirect()->route($this->indexRoute)->with('status', __('translate.updatedSucc'));
    }


    public function edit_password(Request $request, $id)
    {
        $thisResponse = (object)[
            'item' => TargetModel::findOrFail($id),
        ];
        
        return view($this->baseFolder . '.edit_password', ['data' => $thisResponse]);
    }




    public function update_password(Request $request, $id)
    {
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = TargetModel::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();
        
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
