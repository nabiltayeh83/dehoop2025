<?php
namespace App\Http\Controllers\API;
use App\Models\Ad;
use App\Models\Category;
use Image;
use App\Models\Product;
use App\Models\Question;
use App\Models\City;
use App\Models\Cart;
use App\Models\Service;
use App\Models\AdditionService;
use App\Models\Page;
use App\Models\Area;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Token;
use App\Models\NotificationMessage;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;


class ChatController extends Controller
{


      public function sendMessage(Request $request){

        $user_id = auth('api')->id();
        

        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'type' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'validator' => implode("\n", $validator->messages()->all())]);
        }
        
        
        if($request->user == 0 && $request->type==0){
            $title = "محادثات";
            $details = "رسالة جديدة من طرف ";
            $details .= auth('api')->user()->name;
            createAction($title ,$details, 'chats', auth('api')->user()->id);
        }
        
        $chat = Chat::where(['user1'=>$user_id,'user2'=>$request->user])->orWhere('user1',$request->user)->where('user2',$user_id)->first();
       
        if($chat){
            $chat_id = $chat->id;
            $mess = new ChatMessage();
            $mess->chat_id = $chat_id;
            $mess->sender_id = $user_id;
            
            if($request->type==0) {
                $mess->message = $request->message;
                $mess->type = 0;
            }else{
                if($request->hasFile('image')) {
                    $files = $request->file('image');
                    $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
                    Image::make($files)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/chats/$file_name");
                    $mess->message=$file_name;
                    $mess->type = 1;
                }
                
            }
            
            $done=$mess->save();
            if($done){
                $chat->last_seen =now();
                $chat->save();
            }
                
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
            $chat->delete = 0;
            $chat->save();
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
        
        $chat= new Chat();
        $chat->user1 = $user_id;
        $chat->user2 = $request->user;
        $add = $chat->save();
        
        if($add){
            $chat_id = $chat->id;
            $mess = new ChatMessage();
            $mess->chat_id = $chat_id;
            $mess->sender_id = $user_id;
            if($request->type==0) {
                $mess->message = $request->message;
                $mess->type = 0;
            }else{
                if($request->hasFile('image')) {
                    $files = $request->file('image');
                    $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
                    Image::make($files)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/chats/$file_name");
                    $mess->message=$file_name;
                }
                $mess->type = 1;
            }
            $done= $mess->save();
            
            if($done){
                $chat->last_seen =now();
                $chat->save();
            }
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
        $message = __('api.whoops');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }
    
    
    

    public function getMessages(){ 

        $user_id = auth('api')->id();
        $chat=Chat::where('user1',$user_id)->where('delete','<>',$user_id)->orWhere('user2',$user_id)->where('delete','<>',$user_id)->orderBy('freez', 'desc')->orderBy('last_seen', 'desc')->paginate(20);

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message,'chat'=>$chat]);
    }
    
    
    
    

    public function getChatMessage(Request $request)
    {
        
        // $user_id2 = $request->user_id;


        // $user_id = auth('api')->id();
        


        $chat = Chat::where(['user1'=>auth('api')->id(),'user2'=>$request->user_id])->orWhere('user1',$request->user_id)->where('user2',auth('api')->id())->first();
        
        
        if($chat){
            $messages = ChatMessage::where('chat_id', $chat->id)->orderBy('id', 'asc')->get();
            ChatMessage::where('chat_id', $chat->id)->where('sender_id','<>',auth('api')->id())->update(['read_at'=>1]);
             
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message,'messages'=>$messages]);
        }
        
        $message = __('api.not_found');
        return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
    }



    public function checkUserChat(Request $request)
    {
       $user_id = auth('api')->id();
       $user = $request->user_id;

        $chat=Chat::where(['user1'=>$user_id,'user2'=>$user]) ->orWhere('user1',$user)->where('user2',$user_id)->first();
                

        if($chat){
            $messages = ChatMessage::where('chat_id', $chat->id)->orderBy('id', 'asc')->get();
            ChatMessage::where('chat_id', $chat->id)->where('sender_id','<>',$user_id)->update(['read_at'=>1]);
    
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message , 'messages'=>$messages ,' chat'=> $chat]);
        }
        
            $message = __('api.not_found');
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
    }
    
    
    
    
    public function freezChat($id)
    {
        $user_id = auth('api')->id();
          
        $check =Chat::where('user1',$user_id)->orWhere('user2',$user_id)->get();
        $count=$check->where('freez',1)->count();
           
        if($count<3){ 
            $chat=Chat::findOrFail($id);
            $chat->freez=1;
            $chat->save();      
        
        if($chat){
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
    }else{
        $message = __('api.maxpin3');
        return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
    }
        $message = __('api.not_found');
        return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
    }
    
    
    

    public function unFreezChat($id)
    {
        $chat=Chat::findOrFail($id);
        $chat->freez = 0;
        $chat->save();      
        
        if($chat){
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
            $message = __('api.not_found');
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
    }




    public function deleteChat($id)
    {

        $user_id = auth('api')->id();
        $chat=Chat::findOrFail($id);
            if($chat->user1 == $user_id || $chat->user2 == $user_id){
                if($chat->delete == 0){
                    $chat->delete = $user_id;
                    $chat->save();
                }else{
                    $chat->delete();
                }
                $message = __('api.ok');
                return mainResponse(true, $message,null, 200, 'items', '');
            }
            $message = __('api.whoops');
        return mainResponse(false, $message, [], 200, 'items', '');
            
    }
    
    
    
    public function deleteChatMessage(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'chat_msg_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 201, 'message' =>implode("\n",$validator->messages()->all())]);
        }
        
        ChatMessage::where('id', $request->chat_msg_id)->delete();
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok') ]);
    }
    
    
    
}
