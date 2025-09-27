<?php
namespace App\Http\Controllers\WEB\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Category;
use App\Models\PageTranslation;
use App\Models\Page;


class pagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,

        ]);
    }
    public function privacy()
    {
        $item = Page::where('id', '2')->first();
        $setting=Setting::all();
        $categories=Category::all(); 
        return view('website.pages.privacy', [
            'categories' =>$categories,
            'item' =>$item ,
            'setting' =>$setting,
        ]);
    }


    public function about()
    {

       $setting=Setting::all();
       $categories=Category::all(); 
       $item = Page::where('id', '1')->first();
      //dd();
       return view('website.pages.aboutUs', [
        'categories' =>$categories,
        'item' =>$item ,
        'setting' =>$setting,
        ]);
     }

     public function term()
     {
 
        $setting=Setting::all();
        $categories=Category::all(); 
        $item = Page::where('id', '3')->first();
       //dd();
        return view('website.pages.term', [
         'categories' =>$categories,
         'item' =>$item ,
         'setting' =>$setting,
         ]);
      }


      public function returnPolicy()
      {
  
         $setting=Setting::all();
         $categories=Category::all(); 
         $item = Page::where('id', '4')->first();
        //dd();
         return view('website.pages.returnPolicy', [
          'categories' =>$categories,
          'item' =>$item ,
          'setting' =>$setting,
          ]);
       }


       public function show($slug)
{
        $item = Page:: where('slug', $slug)->first();
       
        $setting=Setting::all();
       $categories=Category::all(); 
      
     
       return view('website.pages.aboutUs', [
        'categories' =>$categories,
        'item' =>$item ,
        'setting' =>$setting,
        ]);
}
   
}
