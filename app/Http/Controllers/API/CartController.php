<?php

namespace App\Http\Controllers\API;


use App\Models\User;

use App\Models\CartAddition;
use App\Models\City;
use App\Models\Setting;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\UserWallet;
use App\Models\Coupon;

use Carbon\Carbon;


use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Token;
use App\Models\NotificationMessage;

use Illuminate\Support\Facades\Validator;
use Image;
use DB;


class CartController extends Controller
{
    
    public function image_extensions()
    {
        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }




    public function addProductToCart(Request $request)
    {

        $rules = [
            'product_id' => 'required',
            'quantity' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'message' => implode("\n",$validator->messages()->all())]);
        }

        $product = Product::where(['id' => $request->product_id, 'status' => 'active'])->first();
        
        if(!$product){
            return response()->json(['status' => false, 'code' => 200, 'message' => __('api.youCantAddThisProductNow')]);
        }
  
        // if($product->quantity_available < 1){
        //     $message = __('api.quantityNotAvailable');
        //     return response()->json(['status' => false, 'code' => 201, 'message' => $message ]);
        // }
        
        // $product->quantity_available = $product->quantity_available - 1;
        // $product->save();

  

        if(!isset($request->color_id) && !isset($request->size_id)){
            $check_cart =  Cart::where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'color_id' => null, 'size_id' => null])->first();
            if($check_cart){
                $check_cart->quantity = $check_cart->quantity + $request->quantity;
                $check_cart->save();
                $message = __('api.addedToCart');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'cart' => $check_cart ]);
            }
        
            $cart = new Cart();
            $cart->user_id =  Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        
        if(isset($request->color_id) && isset($request->size_id)){
            $check_cart =  Cart::where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'color_id' => $request->color_id, 'size_id' => $request->size_id])->first();
            if($check_cart){
                $check_cart->quantity = $check_cart->quantity + $request->quantity;
                $check_cart->save();
                $message = __('api.addedToCart');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'cart' => $check_cart ]);
            }
        
            $cart = new Cart();
            $cart->user_id =  Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        
        if(isset($request->color_id) && !isset($request->size_id)){
            $check_cart =  Cart::where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'color_id' => $request->color_id, 'size_id' => null])->first();
            if($check_cart){
                $check_cart->quantity = $check_cart->quantity + $request->quantity;
                $check_cart->save();
                $message = __('api.addedToCart');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'cart' => $check_cart ]);
            }
        
            $cart = new Cart();
            $cart->user_id =  Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->color_id = $request->color_id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        
        if(!isset($request->color_id) && isset($request->size_id)){
            $check_cart =  Cart::where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'color_id' => null, 'size_id' => $request->size_id])->first();
            if($check_cart){
                $check_cart->quantity = $check_cart->quantity + $request->quantity;
                $check_cart->save();
                $message = __('api.addedToCart');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'cart' => $check_cart ]);
            }
        
            $cart = new Cart();
            $cart->user_id =  Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->size_id = $request->size_id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        

        $message = __('api.addedToCart');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'cart' => $cart ]);

    }




    public function deleteFromCart(Request $request)
    {
        
        $rules = [
            'cart_id'=> 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'message' => implode("\n",$validator->messages()->all())]);
        }

        $cart = Cart::where(['id' => $request->cart_id])->delete();

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }
    
    
    
    public function clearCartItems(Request $request)
    {

        $cart = Cart::where(['user_id' => Auth::user()->id])->delete();

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }
    
    
    
    
    public function changeQuantity(Request $request)
    {

        $rules = [
            'cart_id' => 'required',
            'type' => 'required|in:decrease,increase',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'message' => implode("\n",$validator->messages()->all())]);
        }

        $cart = cart::where(['id' => $request->cart_id ])->first();
        
        
        if(!$cart){
              $message = __('api.productNotFound');
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }

        
        if ($request->type == 'increase') {
            $newValue = $cart->quantity + 1;
            $cart->update(['quantity' => $newValue]);
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'cart'=>$cart]);
        }
        
        
        if ($request->type == 'decrease' ) {
            if($cart->quantity == 1){
                $cart->delete();
                $message = __('api.deleteFromCart');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
            }

            $newValue = $cart->quantity - 1;
            $cart->update(['quantity'=>$newValue]);
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'cart'=>$cart]);
        } 
    }
    



    public function myCart(Request $request)
    {
       
        $check_cart =  Cart::where(['user_id' => Auth::user()->id])->get();

        $sub_total = 0;
        $total_price = 0;
        $final_total = 0;
        $settings = Setting::orderBy('id','desc')->first();
        
        
        
        foreach($check_cart as $one){
            $sub_total += $one->quantity * $one->product->active_price;
            // $total_price += $one->quantity * $one->product->active_price;
        }
        
        // $discount = 0;
        
        $final_total = $sub_total + $settings->delivery_cost;


        // if($request->coupon){
        //     $date = date('Y-m-d');
        //     $checkCoupon = Coupon::where('name', $request->coupon)->whereDate('end','>=', $date)->whereDate('start','<=', $date)->where('status','active')->first();
            
        //     if(!$checkCoupon){
        //         return response()->json(['status' => false, 'code' => 201, 'message' => __('api.couponError') ]);  
        //     }else{
        //         $discount = $checkCoupon->discount;
        //         $final_total = $total_price - ($total_price / $discount);
        //     }
        // }else{
        //     $final_total = $total_price;
        // }
        
        $delivery_times = carbon::now()->addDays($settings->delivery_days_count);

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 
                                                                   'myCart' => $check_cart, 
                                                                   'sub_total' => $sub_total, 
                                                                   'delivery_cost' => $settings->delivery_cost, 
                                                                   'delivery_days_count' => $settings->delivery_days_count, 
                                                                   'delivery_times' => $delivery_times,
                                                                   'tax_pecent' => $settings->tax,
                                                                   'tax_amount' => ($sub_total * $settings->tax)  / 100,
                                                                   'final_total' => $final_total + ($sub_total * $settings->tax)  / 100
                                                                   ]);
    }




    public function checkCoupon(Request $request)
    {

        $rules = [
            'coupon' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'message' => implode("\n", $validator->messages()->all())]);
        }

        $date = date('Y-m-d');

        $coupon = Coupon::where('name', $request->coupon)->whereDate('end','>=',$date)->whereDate('start','<=',$date)->where('status','active')->first();

            if(isset($coupon)){
                return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'coupon' => $coupon]);
            } else{
                return response()->json(['status' => false, 'code' => 200, 'message' =>__('api.couponError')]);
            }
    }



    
    public function checkout(Request $request)
    {

        $rules = [
            'payment_method' => 'required',
            'user_address_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json(['status' => false, 'code' => 200, 'message' =>implode("\n",$validator->messages()->all())]);
        }
        
        
        $checkCart =  Cart::where('user_id', Auth::user()->id)->get();
        
        if(count($checkCart) == 0){
            $message = __('api.not_found');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'cart' => $checkCart]);
        }
        
        
        // if($request->coupon){
        //     $date = date('Y-m-d');
        //     $checkCoupon = Coupon::where('name', $request->coupon)->whereDate('end','>=', $date)->whereDate('start','<=', $date)->where('status','active')->first();
            
        //     if(!$checkCoupon){
        //         return response()->json(['status' => false, 'code' => 201, 'message' => __('api.couponError') ]);  
        //     } 
        // }
        

        $sub_total = 0;
        // $checkUserAddress = UserAddress::where('id', $request->user_address_id)->first();
        
        // if($checkUserAddress){
        //     $delivery_cost = $checkUserAddress->city->delivery_cost;
        // }
        // else{
        //     $delivery_cost = 0;
        // }
        
        
        $settings = Setting::orderBy('id','desc')->first();
        
        $delivery_times = carbon::now()->addDays($settings->delivery_days_count);
        

        foreach($checkCart as $one){
            $price = $one->product->active_price;
            $sub_total += $price * $one->quantity;
            
            $all_products[] = [
                'cart_id' => $one->id,
                'product_id' => $one->product_id,
                'quantity' => $one->quantity,
                'color_id' => $one->color_id,
                'size_id' => $one->size_id,
                'price' => $price
            ];
        } 
        

        $final_total = $sub_total + $settings->delivery_cost;
        
        
        $order = new Order();
        $order->user_id = auth('api')->user()->id;
        $order->user_address_id = $request->user_address_id;
        $order->payment_method = $request->payment_method;
        $order->delivery_cost = $settings->delivery_cost;
        $order->delivery_days_count = $settings->delivery_days_count;
        $order->delivery_times = $delivery_times;
        $order->sub_total = $sub_total;
        $order->final_total = (string)$final_total;
        // $order->final_total = $final_total;
        $order->save();
        
        
        for ($i = 0; count($all_products) > $i; $i++) {
            $order_products = new OrderProduct();
            $order_products->order_id = $order->id;
            $order_products->product_id = $all_products[$i]['product_id'];
            $order_products->color_id = $all_products[$i]['color_id'];
            $order_products->size_id = $all_products[$i]['size_id'];
            $order_products->quantity = $all_products[$i]['quantity'];
            $order_products->price = $all_products[$i]['price'];
            $order_products->save();
        }
        
        Cart::where('user_id', auth('api')->user()->id)->update(['order_id' => $order->id]);
        Cart::where('user_id', auth('api')->user()->id)->delete();
        
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'order' => $order]);
    }
    
    

    
    
    



}
