<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact as TargetModel;

use Carbon\Carbon;
use App\Models\Language;

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


class ContactController extends Controller
{


    public function __construct()
    {
        $this->baseFolder = 'admin.contacts';
        $this->indexRoute = 'admin.Contact.index';
        $this->locales = Language::all();
        view()->share(['locales' => $this->locales]);
    }



    public function index(Request $request)
    {
        
        $items = TargetModel::query();

        $thisResponse = (object)[
            'items' => $items->latest('id')->paginate(20),
        ];
        
        return view($this->baseFolder . '.home', ['data' => $thisResponse]);
    }


    public function show($id)
    {

        TargetModel::query()->where('id', $id)->update(['seen' => 1]);

        $thisResponse = (object)[
            'item' =>  TargetModel::findOrFail($id),
        ];
        
        return view($this->baseFolder . '.show', ['data' => $thisResponse]);
    }


    public function update(Request $request, $id)
    {

        $item = TargetModel::query()->findOrFail($id);
        $item->status = $request->status;
        $item->save();
        return redirect()->route($this->indexRoute)->with('status', __('translate.updatedSucc'));
    }


    public function destroy($id){
        $item = TargetModel::query()->findOrFail($id)->delete();
    }
    
    public function replayMessage(Request $request){
        TargetModel::where('id', $request->contact_id)->update(['replay' => 1]);
        createNotification($request->user_id, 'contacts', $request->contact_id, $request->replay);
        createFirebaseNotification($request->user_id, 'contacts', $request->replay);
        return redirect()->route($this->indexRoute);
    }



}
