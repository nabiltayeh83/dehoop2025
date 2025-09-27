<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language as TargetModel;

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


class LanguageController extends Controller
{


    public function __construct()
    {
        $this->baseFolder = 'admin.languages';
        $this->indexRoute = 'admin.Language.index';
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



    public function create()
    {
        return view($this->baseFolder  . '.createEdit');
    }




    public function store(Request $request)
    {

        $roles = [
            'code' => 'required',
        ];

        $locales = Language::all()->pluck('code');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
        }
        $this->validate($request, $roles);

        $item = new TargetModel();
        $item->code = $request->code;
 
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        
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
    
        $roles = [
            'code' => 'required',
        ];

        $locales = Language::all()->pluck('code');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
        }
        $this->validate($request, $roles);

        $item = TargetModel::findOrFail($id);
        $item->code = $request->code;
 
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        
        $item->save();

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
