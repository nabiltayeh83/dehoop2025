<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Language;

use App\Models\Page as TargetModel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;


class PageController extends Controller
{

  
    public function __construct()
    {
        $this->baseFolder = 'admin.pages';
        $this->indexRoute = 'admin.Page.index';
        $this->locales = Language::all();
        view()->share(['locales' => $this->locales]);
    }
    
    
    
    public function index(Request $request)
    {
        $items = TargetModel::query();
        
        $thisResponse = (object)[
            'items' =>  $items->latest('id')->paginate(20),
        ];
        
        return view($this->baseFolder . '.home', ['data' => $thisResponse]);
    }
    

   
    public function create()
    {
        return view($this->baseFolder . '.createEdit');
    }

  
  
    public function store(Request $request)
    {
        
        
        // $roles = [
        //     'driver_id' => 'required',
        //     'car_type_id' => 'required',
        //     'plate_number' => 'required',
        //     // 'colour' => 'required',
        // ];

        // $this->validate($request, $roles);
        
        $item = new TargetModel(); 

        $locales = Language::all()->pluck('code');
        
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $item->translateOrNew($locale)->details = $request->get('details_' . $locale);
            $item->translateOrNew($locale)->keywords = $request->get('keywords_' . $locale);
        }
        
        if(isset($request->image)){
            $item->image = uploadImage($request->image, 'pages');
        }
        
        $item->save();
        
        return redirect()->route($this->indexRoute)->with('status', __('translate.createdSucc'));
    }



    public function show($id)
    {
        
        $thisResponse = (object)[
            'item' => TargetModel::findOrFail($id),
        ];
        
        return view($this->baseFolder . '.show', ['data' => $thisResponse]);
    }

  
  
    public function edit($id)
    {

        $thisResponse = (object)[
            'item' => TargetModel::findOrFail($id),
        ];
        
        return view($this->baseFolder . '.createEdit', ['data' => $thisResponse]);
    }



    public function update(Request $request, $id)
    {

    //   $roles = [
    //         'driver_id' => 'required',
    //         'car_type_id' => 'required',
    //         'plate_number' => 'required',
    //         // 'colour' => 'required',
    //     ];

    //     $this->validate($request, $roles);
        
        $item = TargetModel::query()->findOrFail($id);
        $locales = Language::all()->pluck('code');
        
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $item->translateOrNew($locale)->details = $request->get('details_' . $locale);
            $item->translateOrNew($locale)->keywords = $request->get('keywords_' . $locale);
        }
        
        if(isset($request->image)){
            $item->image = uploadImage($request->image, 'pages');
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
