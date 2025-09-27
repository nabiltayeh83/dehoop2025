<?php
namespace App\Http\Controllers\WEB\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Language;
use App\Models\Category;
use App\Models\ProductImage;

use App\Models\Product;
use App\Models\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
 
 
    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,
        ]);
    }
    

    public function login()
    {
        if(auth()->check())   {
            return redirect('/home');
         }
         else{
           
        $setting=Setting::all()->where('status','active');
        $categories=Category::all();
        return view('website.login', [
            'setting' =>$setting,
            'categories' =>$categories,
        ]);
            }
    }


    
    public function loginPost(Request $request)
    {
        
        $rules = [
            'emailOrMobile' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->toArray())->withInput();
        }
        if (filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL)) {
            $conditions = ['email' => $request->emailOrMobile, 'password' => $request->password];
        }
        else {
            $conditions = ['mobile' => $request->emailOrMobile, 'password' => $request->password];
        }
        if (Auth::attempt($conditions)) {
            // if (Auth::user()->ban == 0) {
                if (Auth::user()->status == 'active') {
                    $user = Auth::user();
                    return redirect('/home');
                } else {
                    auth()->logout();
                    return redirect()->back()->with('error',__('site.AccountNotActive'));
                }
        }
        return redirect()->back()->with('error',__('site.MobileOrPasswordAreWrong'));
    }



    public function logout(Request $request)
    {
        auth()->logout();

        return redirect('/home');
    }
    

    public function signupPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|min:7|max:10|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'name' => 'required',
        ]);
        
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->toArray())->withInput();
        }
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->password = bcrypt($request->password);
        $newUser->mobile = $request->mobile;
        $newUser->type = 0;
        $newUser->email = $request->email;
        $newUser->status = 'active';
        


        $done = $newUser->save();
        if ($done) {

            if($request->type == 3) {
                $code = rand(10000, 99999);
                $code = '1111';
                $bodySMS = __('site.ActivationMsg') . " هو : " . $code;
                // sendSMS($mobile,$bodySMS);
                $conf = new Code();
                $conf->code = $code;
                $conf->user_id = $newUser->id;
                $conf->save();
                $newData = ['status' => true, 'code' => 200, 'message' => 'تم ارسال رمز التفعيل بنجاح'];
                return response()->json($newData);
            }
            if($request->type == 2 || $request->type == 1) {
                $user = User::findOrFail($request->university_id);
                $new = new Following();
                $new->userFrom = $newUser->id;
                $new->userTo = $request->university_id;
                $followDone = $new->save();
                if($followDone) {
                    Notification::firstOrCreate(['user_id' => $request->university_id,'post_id' => 0,'type' => 5],['seen' => 0]);
                    $total = Following::where('userTo',$request->university_id)->count();
                    $message = "";
                    if($total==1){
                        $message = $request->name ." ".__('site.isFollowingYou');
                    }
                    if($total==2){
                        $message =$request->name . " " . _('site.and') ." "._('site.anotherUserAreFollowingYou');
                    }
                    if($total>2){
                        $total--;
                        $message = $request->name . " " . _('site.and') . " " . $total ." "._('site.usersAreFollowingYou');
                    }
                    $action_type = 'follow';
                    $object_id = $newUser->id;
                    $tokens_android = Token::where('user_id',$request->university_id)->where('device_type','<>',2)->pluck('fcm_token')->toArray();
                    $tokens_ios = Token::where('user_id',$request->university_id)->where('device_type',2)->pluck('fcm_token')->toArray();
                    sendNotificationToUsers( $tokens_android, $tokens_ios, $action_type, $object_id, $message );
                }
            }
            $conditions = ['email'=>$request->email,'password' => $request->password];
            if (Auth::attempt($conditions)) {
                $user = Auth::user();
                return redirect('/');
            }
            return redirect()->back()->withErrors([ __('site.Whoops')])->withInput();
        } else {
            return redirect()->back()->withErrors([ __('site.Whoops')])->withInput();
        }
    }
}
