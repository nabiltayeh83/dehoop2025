<?php
namespace App\Http\Controllers\WEB\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Language;
use App\Models\Category;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Page;
use App\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
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
    public function index()
    {
       
        $categories=Category::all()->where('status','active');
        $produts=Product::all()->where('id',1);
        $setting=Setting::all();
        $user=auth()->user();
        $slider1=Product::orderBy('created_at','desc')->first();;
        $slider2=Product::orderBy('created_at','desc')->skip(1)->take(1)->get()->first();

        return view('website.profile', [
            'categories' =>$categories,
            'produts' =>$produts,
            'setting' =>$setting,
            'user' =>$user,
            'slider2' =>$slider2,
        ]);
    }


    public function myOrder()
    {
        $setting=Setting::all();
        $categories=Category::all(); 

        $orders=Order::with('products')->where('user_id',Auth::user()->id)->get();
       
     

        return view('website.myOrder', [
            'categories' =>$categories,
            'orders' =>$orders,
            'setting' =>$setting,
         
        ]);
    }



    public function update(Request $request, $id)
    {
          $user=User::findOrFail(auth()->user()->id);
        
          $user->name=$request->input('name');
          $user->mobile=$request->input('mobile');
          //$user->phone=$request->input('phone');

          if($request->password != ''){
            $user->password =  Hash::make($request->password);
        }

          $user->save();
           
          return back()->with('status', 'user details has been updated');
    } 

    
   
}
