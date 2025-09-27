<?php
namespace App\Http\Controllers\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

use App\Models\User;
use App\Admin;

use App\Models\Language;
use App\Models\Setting;

use App\Models\Page;
use App\Models\Contact;
use App\Models\Collection;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Partner;
use App\Models\Email;



use Carbon\Carbon;


use QrCode;
use Image;
use Session;
use Mail;

use Illuminate\Support\Str;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class FrontController extends Controller
{
  
    
    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share(['locales' => $this->locales, 'settings' => $this->settings]);
    }


    
    public function index()
    {
        // $brands = Brand::active()->get(); 
        // $collections = Collection::active()->get(); 
        // $sliders = Slider::active()->get(); 
        // $partners = Partner::active()->get(); 
        return view('website.home');
    }
    
    
    public function aboutUs()
    {

        $mission = Page::where('id', 17)->first(); 
        $history = Page::where('id', 16)->first(); 
        return view('website.aboutUs', ['mission' => $mission, 'history' => $history]);
    }
    
    
    public function ourPartner()
    {
        $items = Partner::active()->get(); 
        return view('website.ourPartner', ['items' => $items]);
    }
    
    public function ourBrands()
    {
        return view('website.ourBrands');
    }
    
    
    public function ourCollections()
    {
        $items = Collection::active()->get(); 
        return view('website.ourCollections', ['items' => $items ]);
    }
    
    
    public function collectionDet($id)
    {
        $item = Collection::where('id', $id)->first(); 
        return view('website.collectionDet', ['item' => $item ]);
    }
    
    
    public function PartnerDet($id)
    {
        $item = Partner::where('id', $id)->first(); 
        return view('website.PartnerDet', ['item' => $item ]);
    }
    
    

    public function contactUs()
    {
        return view('website.contactUs');
    }
    
    

    public function storeContactMsg(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = new Contact();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->subject = $request->subject;
        $item->message = $request->message;
        $item->save();
        
        return true;

    }



    public function storeMailList(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $checkEmail = Email::where('email', $request->email)->first();
        
        if(!$checkEmail){
            $item = new Email();
            $item->email = $request->email;
            $item->save();    
        }
        
        return true;

    }

    
   
}
