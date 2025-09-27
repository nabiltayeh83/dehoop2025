<?php

namespace App\Http\Controllers\API;
use App\Admin;
use App\Models\CartAddition;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Code;
use App\Notifications\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Token;
use App\Models\OrderProduct;
use App\Models\UserAddress;
use App\Models\Setting;
use App\Models\PaymentCard;

use App\Models\Opportunity;
use App\Models\OpportunityModel;
use App\Models\OpportunityPlan;
use App\Models\OpportunityWebsite;


use App\Models\Feedback;


use App\Models\Notify;
use App\Models\City;
use App\Models\Reminder;
use App\Models\SpecialRequest;
use App\Models\Notifiy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Image;
use DB;
use Twilio;

class UserController extends Controller
{
    use SendsPasswordResetEmails;



    public function broker()
    {
        return Password::broker('users');
    }
    
    
    public function image_extensions()
    {
        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }




    public function signUpUsers(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required|unique:users,mobile,NULL,id,deleted_at,NULL',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 201, 'message' =>implode("\n",$validator->messages()->all())]);
        }

        $checkUser = User::where('mobile', $request->mobile)->first();
        if($checkUser){
            return response()->json(['status' => false, 'code' => 200, 'message' => 'The mobile number is already in use'  ]);
        }

        $newUser = new User();
        $newUser->mobile = $request->mobile;
        $newUser->save();

        if ($newUser) {
            if ($request->has('fcm_token')) {
                Token::updateOrCreate(['device_type' => $request->get('device_type'),'fcm_token' => $request->get('fcm_token')],['user_id' => $newUser->id]);
            }

            // $code = rand(1000, 9999);
            $code = 1111;
            $conf = new Code();
            $conf->code = $code;
            $conf->user_id = $newUser->id;
            $conf->save();
            
            return response()->json(['status' => true, 'code' => 200, 'message' => 'Account created successfully', 'data' => $newUser]);
        }
        return response()->json(['status' => false, 'code' => 201, 'message' => __('api.whoops')]);
    }



    public function loginForUsers(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 201, 'message' =>implode("\n",$validator->messages()->all())]);
        }

        $checkUser = User::where('mobile', $request->mobile)->first();
        
        // return $checkUser;
        
        if(!$checkUser){
            return response()->json(['status' => false, 'code' => 201, 'message' => 'This number not registered' ]);
        }
        
        
        if ($request->has('fcm_token')) {
            Token::updateOrCreate(['device_type' => $request->get('device_type'), 'fcm_token' => $request->get('fcm_token')], ['user_id' => $checkUser->id]);
        }
        
        // $code = rand(1000, 9999);
        $code = 1111;
        $conf = new Code();
        $conf->code = $code;
        $conf->user_id = $checkUser->id;
        $conf->save();
        
        // $msg = 'Validation Code is ' . $code;
        return response()->json(['status' => true, 'code' => 200, 'message' => 'login successfully', 'data' => $checkUser]);
 
    }
    



    public function startFundRaise(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'work_type' => 'required',
            'amount_raise' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 201, 'message' =>implode("\n",$validator->messages()->all())]);
        }
        
        //  $user_id = auth('api')->id();
        $user = User::where('mobile', $request->mobile)->first();
    
        if($user){
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;
            $user->work_type = $request->work_type;
            $user->amount_raise = $request->amount_raise;
            $user->save();
            
            $user['access_token'] = $user->createToken('mobile')->accessToken;            
        }

        
        // $access_token = Token::where('user_id', $user->id)->first();
        // return$access_token;

        return response()->json(['status' => true, 'code' => 200, 'message' =>__('api.ok'), 'data' => $user]);
    }


    
    public function profile(){
        if(isset(auth('api')->user()->id)) {
            $user = auth('api')->user();
            $user['access_token'] = $user->createToken('mobile')->accessToken;
            
            $opportunityIDS = Feedback::where('user_id', auth('api')->user()->id)->pluck('opportunity_id')->toArray();
            $ventures = Opportunity::query()->whereIn('id', $opportunityIDS)->without(['models', 'plans', 'websites'])->get();
        
            foreach($ventures as $item){
                $item->models = OpportunityModel::where('opportunity_id', $item->id)->pluck('title')->toArray();
                $item->plans = OpportunityPlan::where('opportunity_id', $item->id)->pluck('title')->toArray();
                $item->websites = OpportunityWebsite::where('opportunity_id', $item->id)->pluck('url')->toArray();        
            }
            
            $user->ventures = $ventures;
            
         
            return response()->json(['status' => true, 'code' => 200, 'message' =>__('api.ok'), 'data' => $user ]);
        }
        return response()->json(['status' => false, 'code' => 201, 'message' =>__('api.nopermission')]);
    } 
    
    
    
    public function checkCode(Request $request)
    {

        $rules = [
            'code' => 'required',
            'mobile' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
             return response()->json(['status' => false, 'code' => 200, 'message' =>implode("\n",$validator->messages()->all())]);
        }
    
        $checkUser = User::where('mobile', $request->mobile)->first();

        if($checkUser){
            $checkCode = Code::where(['user_id' => $checkUser->id, 'code' => $request->code, 'used' => 0])->orderBy('id', 'desc')->first();
               
            if ($request->has('fcm_token')) {
                Token::updateOrCreate(['device_type' => $request->get('device_type'), 'fcm_token' => $request->get('fcm_token')], ['user_id' => $checkUser->id]);
            }
            
            
            if($checkCode){
                Code::where('id', $checkCode->id)->update(array('used' => 1));
                Code::where('user_id', $checkUser->id)->delete();
                
                Auth::guard('web')->login($checkUser);
                $checkUser['access_token'] = $checkUser->createToken('mobile')->accessToken;
                
                return response()->json(['status' => true, 'code' => 200, 'message' => 'Your account has been activated' , 'data' => $checkUser]);
            }
            else {
                return response()->json(['status' => false, 'code' => 201, 'message' => __('api.not_valid_code')]);
            }
        }

        return response()->json(['status' => false, 'code' => 201, 'message' => 'Please enter true mobile number' ]);
    }
    
    

    public function editProfile(Request $request)
    {
        
        $user_id = auth('api')->id();
        $user = User::findOrFail($user_id);

        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required|unique:users,mobile,'.$user_id,
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['status' => false, 'code' => 201, 'message' =>implode("\n",$validator->messages()->all())]);
        // }
        
        $user->name = $request->name;
        // $user->mobile = $request->mobile;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->location = $request->location;
        
        if ($request->hasFile('image_profile')) {
            $image = $request->file('image_profile');
            $extention = $image->getClientOriginalExtension();
            $file_name = rand(1000000, 9999999) . "_" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->save("uploads/users/$file_name");
            $user->image_profile = $file_name;
        }
        
        $done =  $user->save();

        $user['access_token'] = $user->createToken('mobile')->accessToken;
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Data updated successfully', 'data' => $user]);
        }


    public function logout()
    {
        $user_id = auth('api')->id();
        Token::where('user_id', $user_id)->delete();
        if (auth('api')->user()->token()->revoke()) {
            $message = 'logged out successfully';
            return response()->json(['status' => true, 'code' => 200,
                'message' => $message ]);
        } else {
            $message = 'logged out successfully';
            return response()->json(['status' => true, 'code' => 202,
                'message' => $message ]);
        }
    }
    
    
    public function reSendCode(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'message' =>implode("\n",$validator->messages()->all())]);
        }

        $checkUser = User::where('mobile', $request->mobile)->first();
        
        if($checkUser){
            Code::where('user_id', $checkUser->id)->delete();
            // $code = rand(1000, 9999);
            $code = 1111;
            $conf = new Code();
            $conf->code = $code;
            $conf->user_id = $checkUser->id;
            $conf->save();
            
            $msg = 'Validation Code is ' . $code;
            return response()->json(['status' => true, 'code' => 200, 'message' => 'Activation code sent to your email', 'data' => $checkUser]);
        }    

        return response()->json(['status' => false, 'code' => 201, 'message' => 'Please enter true mobile number' ]);
    }
    





}
