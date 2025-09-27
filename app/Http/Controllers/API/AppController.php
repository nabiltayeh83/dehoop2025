<?php
namespace App\Http\Controllers\API;

use App\Models\Token;
use App\Models\NeedType;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Notification;
use App\Models\Rate;
use App\Models\Language;
use App\Models\Task;

use App\Models\Resource;
use App\Models\Campaign;
use App\Models\FundType;
use App\Models\Goal;
use App\Models\Lesson;
use App\Models\Opportunity;
use App\Models\NeedTypeVisit;

use App\Models\Project;
use App\Models\MinistryIdea;
use App\Models\Feedback;
use App\Models\VolunteerRequest;

use App\Models\OpportunityModel;
use App\Models\OpportunityPlan;
use App\Models\OpportunityWebsite;
use App\Models\ResourceLesson;
use App\Models\WorthyCause;
use App\Models\Donation;
use App\Models\NeedTypeCategory;
use App\Models\NeedTypeChild;

use App\Models\DonationSetting;
use App\Models\OpportunitySpecificItem;


use Carbon\Carbon;

use App\Models\User;
use DB;
use Image;
use QrCode;

use Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{



    public function getNeedMainCategory()
    {
        $categories = NeedTypeCategory::query()->active()->where('type', 'main')->get();
        
        $thisResponse = (object)[
            'categories' => $categories,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }

    
    public function getNeedSubCategory(Request $request)
    {
        
        $categories = NeedTypeCategory::query()->active()->where('type', 'sub')->get();
        
        $thisResponse = (object)[
            'categories' => $categories,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }

    
    
    public function privacyPolicy()
    {
        $privacyPolicy = Page::where('id', 2)->first();
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $privacyPolicy ]);
    }
    
    
    public function termsAndConditions()
    {
        $termsAndConditions = Page::where('id', 3)->first();
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $termsAndConditions ]);
    }
    

    public function userHomeScreen(Request $request)
    {
        
        $main_needs_types = NeedType::query()->active();
            
        if($request->get('txt')){
            $main_needs_types = $main_needs_types->whereTranslationLike('name', '%' . $request->get('txt') . '%');
        }
        
        if($request->get('main_category_id')){
            $main_needs_types = $main_needs_types->where('main_category_id', $request->get('main_category_id'));
        }
        
        if($request->get('sub_category_id')){
            $main_needs_types = $main_needs_types->where('sub_category_id', $request->get('sub_category_id'));
        }
        
        $main_needs_types = $main_needs_types->get();
        
        $recommendedMinistries = NeedType::query()->active()->orderBy('views_count', 'desc')->take(3)->get();
        
        $recentlyViewedIDs = NeedTypeVisit::where('user_id', auth('api')->user()->id)->latest('id')->take(3)->pluck('need_type_id')->toArray();
        $recentlyViewed = NeedType::whereIn('id', $recentlyViewedIDs)->get();
        
        $thisResponse = (object)[
            'main_needs_types' => $main_needs_types,
            'recentlyViewed' => $recentlyViewed,
            'recommendedMinistries' => $recommendedMinistries,
        ];    
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }
    
    
    
    public function userHomeScreenFilter(Request $request)
    {
        
        $main_needs_types = NeedType::query()->active();
            
        if($request->get('txt')){
            $main_needs_types = $main_needs_types->whereTranslationLike('name', '%' . $request->get('txt') . '%');
        }
        
        if($request->get('main_category_id')){
            $main_needs_types = $main_needs_types->where('main_category_id', $request->get('main_category_id'));
        }
        
        if($request->get('sub_category_id')){
            $main_needs_types = $main_needs_types->where('sub_category_id', $request->get('sub_category_id'));
        }
        
        $main_needs_types = $main_needs_types->get();
        
        $recommendedMinistries = NeedType::query()->active()->orderBy('views_count', 'desc')->take(3)->get();
        
        $recentlyViewedIDs = NeedTypeVisit::where('user_id', auth('api')->user()->id)->latest('id')->take(3)->pluck('need_type_id')->toArray();
        $recentlyViewed = NeedType::whereIn('id', $recentlyViewedIDs)->get();
        
        $thisResponse = (object)[
            'main_needs_types' => $main_needs_types,
            'recentlyViewed' => $recentlyViewed,
            'recommendedMinistries' => $recommendedMinistries,
        ];    
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }
    
    


    public function getSubNeedsTypes(Request $request)
    {
        
        $sub_needs_types = NeedType::query()->active();
        
        if($request->need_type_id){
            $sub_needs_types = $sub_needs_types->where('id', $request->need_type_id);    
        }
        
        if($request->need_type_category_id){
            $sub_needs_types = $sub_needs_types->where('main_category_id', $request->need_type_category_id);    
        }
        
        $sub_needs_types = $sub_needs_types->get();
        
        
        foreach($sub_needs_types as $one){
            $one->update(['views_count' => $one->views_count + 1 ]);
            
            $needs_types_visits = new NeedTypeVisit();
            $needs_types_visits->need_type_id = $one->id;
            $needs_types_visits->user_id = auth('api')->user()->id;
            $needs_types_visits->save();
        }
        
        $thisResponse = (object)[
            'sub_needs_types' => $sub_needs_types,
        ];
    
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }
    
    
    public function sendContactMsg(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $contact = new  Contact();
        $contact->user_id = auth('api')->user()->id;
        $contact->message = $request->message;
        $contact->save();
    
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Your message sent successfully', 'data' => $contact ]);
    
    }



    public function createVolunteerRequest(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $item = new  VolunteerRequest();
        $item->user_id = auth('api')->user()->id;
        $item->title = $request->title;
        $item->location = $request->location;
        $item->date = $request->date;
        $item->time = $request->time;
        $item->details = $request->details;
        $item->save();
        
        
        $usersIds = User::where('status', 'active')->pluck('id')->toArray();
        
        foreach($usersIds as $user_id){
            $newNotification = new Notification();
            $newNotification->user_id = $user_id;
            $newNotification->tag = 'volunteer_request';
            $newNotification->tag_id = $item->id;
            $newNotification->title = 'Volunteer Request';
            $newNotification->message = $request->title;
            $newNotification->save();
        }  
          
            $message = $request->title;
            
            $action_type = 'notification';
            $object_id = $request->title;
            $tokens_android = Token::whereIn('user_id', $usersIds)->where('device_type', 'android')->pluck('fcm_token')->toArray();
            $tokens_ios = Token::whereIn('user_id', $usersIds)->where('device_type', 'ios')->pluck('fcm_token')->toArray();
            sendNotificationToClient( $tokens_android, $tokens_ios, $action_type, $object_id, $message );
            
            return response()->json(['status' => true, 'code' => 200, 'message' => 'Your volunteer request sent successfully', 'data' => $item ]);
    
    }
    
    
    
    public function createProject(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $item = new Project();
        $item->user_id = auth('api')->user()->id;
        $item->title = $request->title;
        $item->details = $request->details;
        $item->time_commitment = $request->time_commitment;
        $item->monthly_revenue = $request->monthly_revenue;
        $item->save();

        $usersIds = User::where('status', 'active')->pluck('id')->toArray();
        
        foreach($usersIds as $user_id){
            $newNotification = new Notification();
            $newNotification->user_id = $user_id;
            $newNotification->tag = 'project';
            $newNotification->tag_id = $item->id;
            $newNotification->title = 'New Event';
            $newNotification->message = $request->title;
            $newNotification->save();
        }  
          
        $message = $request->title;
        $action_type = 'notification';
        $object_id = $request->title;
        $tokens_android = Token::whereIn('user_id', $usersIds)->where('device_type', 'android')->pluck('fcm_token')->toArray();
        $tokens_ios = Token::whereIn('user_id', $usersIds)->where('device_type', 'ios')->pluck('fcm_token')->toArray();
        sendNotificationToClient( $tokens_android, $tokens_ios, $action_type, $object_id, $message );
            
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Your project created successfully', 'data' => $item ]);
    
    }
    
    
    
    public function createMinistryIdea(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $item = new MinistryIdea();
        $item->user_id = auth('api')->user()->id;
        $item->title = $request->title;
        $item->details = $request->details;
        $item->time_commitment = $request->time_commitment;
        $item->monthly_revenue = $request->monthly_revenue;
        $item->save();
        
        $usersIds = User::where('status', 'active')->pluck('id')->toArray();
        
        
        foreach($usersIds as $user_id){
            $newNotification = new Notification();
            $newNotification->user_id = $user_id;
            $newNotification->tag = 'ministry_idea';
            $newNotification->tag_id = $item->id;
            $newNotification->title = 'New Event';
            $newNotification->message = $request->title;
            $newNotification->save();
        }

        $message = 'New Event';
        $action_type = 'notification';
        $object_id = 'New Event';
        $tokens_android = Token::whereIn('user_id', $usersIds)->where('device_type', 'android')->pluck('fcm_token')->toArray();
        $tokens_ios = Token::whereIn('user_id', $usersIds)->where('device_type', 'ios')->pluck('fcm_token')->toArray();
        sendNotificationToClient( $tokens_android, $tokens_ios, $action_type, $object_id, $message );
        
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Ministry idea created successfully', 'data' => $item ]);
    }
    
    
    
    public function createFeedback(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'opportunity_id' => 'required',
            'review' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
    
        $checkFeedback = Feedback::where(['user_id' => auth('api')->user()->id, 'opportunity_id' => $request->opportunity_id])->first();
        
        if(!$checkFeedback){
            $item = new Feedback();
            $item->user_id = auth('api')->user()->id;
            $item->opportunity_id = $request->opportunity_id;
            // $item->title = $request->title;
            $item->review = $request->review;
            $item->rate = $request->rate;
            
            if($request->file){
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $filename  = time()."_".rand(1,50000). 'feedback.' .$extension;
                $destinationPath = 'uploads/feedbacks/';
                $file->move($destinationPath,$filename);
                $item->file = $filename;
            }
            
            $item->save();    
            return response()->json(['status' => true, 'code' => 200, 'message' => 'Opportunity reviewed successfully', 'data' => $item ]);
        }
        
        return response()->json(['status' => false, 'code' => 200, 'message' => 'Opportunity already reviewed' ]);
    
    }
    
    

    public function getCategories(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'opportunity_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        $categories = Category::query()->active();
        
        if(isset($request->txt)){
            $categories = $categories->where('title', 'like', '%'. $request->txt .'%')->orWhere('sub_title', 'like', '%'. $request->txt .'%')->orWhere('details', 'like', '%'. $request->txt .'%');
        }
        
        $categories = $categories->where('opportunity_id', $request->opportunity_id)->get();
        
        $notificationsCount = Notification::where('user_id', auth('api')->user()->id)->count();
        
        $thisResponse = (object)[
            'notificationsCount' => $notificationsCount,
            'categories' => $categories,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }
    
    
    
    
    public function getResources(Request $request)
    {
        
        $resources = Resource::query()->active();
        
        if(isset($request->txt)){
            $resources = $resources->where('title', 'like', '%'. $request->txt .'%')->orWhere('details', 'like', '%'. $request->txt .'%');
        }
        
        $resources = $resources->where('parent_id', 0)->get();
        
        $thisResponse = (object)[
            'resources' => $resources,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    } 
    
    
    
    public function getResourcesScreen(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'resource_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        $resource = Resource::where('id', $request->resource_id)->first();
        $lessons = ResourceLesson::active()->where('resource_id', $request->resource_id)->get();
        $resource->lessons = $lessons;
        
        $ques_ansers = Resource::active()->where('parent_id', $request->resource_id)->get();
        
        $thisResponse = (object)[
            'resource' => $resource,
            'ques_ansers' => $ques_ansers,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    } 
    
    
    
    public function getResourceLessons(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'resource_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        $resource = Resource::where('id', $request->resource_id)->first();
        $lessons = ResourceLesson::active()->where('resource_id', $request->resource_id)->get();
        
        $thisResponse = (object)[
            'resource' => $resource,
            'lessons' => $lessons,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    } 
    
    
    
    public function createNewGoal(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'deadline' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $item = new Goal();
        $item->user_id = auth('api')->user()->id;
        $item->title = $request->title;
        $item->url = $request->url;
        $item->category_id = $request->category_id;
        $item->deadline = $request->deadline;
        $item->save();
    
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Goal created successfully', 'data' => $item ]);
    
    }
    
    
    
    public function createNewTask(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'all_days' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $item = new Task();
        $item->user_id = auth('api')->user()->id;
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->all_days = $request->all_days;
        $item->start_date = $request->start_date;
        $item->end_date = $request->end_date;
        $item->save();
        
        $newNotification = new Notification();
        $newNotification->user_id = auth('api')->user()->id;
        $newNotification->tag = 'task';
        $newNotification->tag_id = $item->id;
        $newNotification->title = 'New Task';
        $newNotification->message = $request->title;
        $newNotification->save();
        
        $message = $request->title;
        $action_type = 'notification';
        $object_id = $request->title;
        $tokens_android = Token::where('user_id', auth('api')->user()->id)->where('device_type', 'android')->pluck('fcm_token')->toArray();
        $tokens_ios = Token::where('user_id', auth('api')->user()->id)->where('device_type', 'ios')->pluck('fcm_token')->toArray();
        sendNotificationToClient( $tokens_android, $tokens_ios, $action_type, $object_id, $message );
            
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Task created successfully', 'data' => $item ]);
    }
    
    
    public function getMyGoalsBenchmarks(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $activeGoals = Goal::where('user_id', auth('api')->user()->id)->where('category_id', $request->category_id)->where('completed', 'no')->latest('id')->get();
        $pastGoals =   Goal::where('user_id', auth('api')->user()->id)->where('category_id', $request->category_id)->where('completed', 'yes')->latest('id')->get();
        
        $benchmarks[] =  [
            'title' => 'Monthly Revenue',
            'niche_target' => '7,200',
        ];
        
        $benchmarks[] =  [
            'title' => 'Nightly Attendance',
            'niche_target' => '132',
        ];
            
        $thisResponse = (object)[
            'category' => Category::where('id', $request->category_id)->first(),
            'activeGoals' => $activeGoals,
            'pastGoals' => $pastGoals,
            'benchmarks' => $benchmarks,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }
    
    
    
    public function getMyTaskManager(Request $request)
    {
    
        $currentTasks = Task::query();
        
        if(isset($request->txt)){
            $currentTasks = $currentTasks->where('title', 'like', '%'. $request->txt .'%');
        }
        
        $currentTasks = $currentTasks->where('user_id', auth('api')->user()->id)->where('completed', 'no')->latest('id')->get();
        
        
        $completedTasks = Task::query();
        
        if(isset($request->txt)){
            $completedTasks = $completedTasks->where('title', 'like', '%'. $request->txt .'%');
        }
        
        $completedTasks = $completedTasks->where('user_id', auth('api')->user()->id)->where('completed', 'yes')->latest('id')->get();
        
        
        $thisResponse = (object)[
            'currentTasks' => $currentTasks,
            'completedTasks' => $completedTasks,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    
    }
    
    
    
    
    public function markGoalCompleted(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'goal_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $item = Goal::where('id', $request->goal_id)->first();
        $item->update(['completed' => 'yes']);
        
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Goal completed successfully', 'data' => $item ]);
    
    }
    
    
    
    public function markTaskCompleted(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'task_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $item = Task::where('id', $request->task_id)->first();
        $item->update(['completed' => 'yes']);
    
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Task completed successfully', 'data' => $item ]);
    
    }
    
    
    
    
    public function getWorthyCauses(Request $request)
    {
        
        $featuredFunds =  WorthyCause::active()->where('type', 'featured_funds')->where('parent_id', 0)->get();
        $otherFunds    =  WorthyCause::active()->where('type', 'other_funds')->where('parent_id', 0)->get();
        
        $thisResponse = (object)[
            'donation_details' => DonationSetting::first(),
            'featuredFunds' => $featuredFunds,
            'otherFunds' => $otherFunds,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    } 
    
    
    
    
    public function getSubWorthyCauses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'worthy_cause_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        $worthy_causes =  WorthyCause::active()->where('parent_id', $request->worthy_cause_id)->get();

        $thisResponse = (object)[
            'donation_details' => DonationSetting::first(),
            'worthy_causes' => $worthy_causes,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    } 
    
    
    
    public function getWorthyCausesDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'worthy_cause_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        $worthy_cause =  WorthyCause::findOrFail($request->worthy_cause_id);

        $thisResponse = (object)[
            'worthy_cause' => $worthy_cause,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    } 
    
    
    
    
    public function makeDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'worthy_cause_id' => 'required',
            'amount' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        $item = new Donation();
        $item->user_id = auth('api')->user()->id;
        $item->worthy_cause_id = $request->worthy_cause_id;
        $item->amount = $request->amount;
        $item->save();
        
        $thisResponse = (object)[
            'donation' => Donation::findOrFail($item->id),
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Thank you for you donation', 'data' => $thisResponse ]);
    } 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    







    public function viewAllTasks()
    {
        $tasks = Task::where('user_id', auth('api')->user()->id)->latest('id')->get();
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'tasks' => $tasks ]);
    }
    
    



    public function getMyNotifications(Request $request)
    {
        $notifications = Notification::where('user_id', auth('api')->id())->latest('id')->get();
        
        $thisResponse = (object)[
            'notifications' => $notifications,
        ]; 
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }



    public function completeYourRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required',
            'amount' => 'required',
            'work_type' => 'required',  // 
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
    
        $checkUser = User::where('id', auth('api')->user()->id)->first();
        $checkUser->city = $request->city;
        $checkUser->latitude = $request->latitude;
        $checkUser->longitude = $request->longitude;
        $checkUser->save();
        
        $Campaign = new Campaign();
        $Campaign->user_id = auth('api')->user()->id;
        $Campaign->amount = $request->amount;
        $Campaign->work_type = $request->work_type;
        $Campaign->save();
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'user' => $checkUser ]);

    }
    
    
    
    
    public function createNewOpportunity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'nullable',
            // 'latitude' => 'required',
            // 'longitude' => 'required',
            // 'amount' => 'required',
            // 'work_type' => 'required',  // 
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        $item = new Opportunity();
        $item->user_id = auth('api')->user()->id;
        $item->type = $request->type;
        $item->title = $request->title;
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->date = $request->date;
        $item->time = $request->time;
        $item->details = $request->details;
        $item->weekly_time_commitment = $request->weekly_time_commitment;
        $item->monthly_revenue = $request->monthly_revenue;
        $item->save();
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'opportunity' => $item ]);

    }
    
    
    
        
    public function updateOpportunity(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'opportunity_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        $item = Opportunity::where('id', $request->opportunity_id)->first();
        $item->title = $request->title;
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->date = $request->date;
        $item->time = $request->time;
        $item->details = $request->details;
        $item->weekly_time_commitment = $request->weekly_time_commitment;
        $item->monthly_revenue = $request->monthly_revenue;
        $item->save();
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'opportunity' => $item ]);

    }
    
    
    public function deletedOpportunity(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'opportunity_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return mainResponse(false, '' , null, 201, 'items',$validator);
        }
        
        Opportunity::where('id', $request->opportunity_id)->delete();

        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok') ]);

    }
    
    
    
    public function getMyOpportunities(Request $request)
    {
        
        $items = Opportunity::where('user_id', auth('api')->user()->id)->latest('id')->get();
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'my_opportunities' => $items ]);
    }
    
    
    
    
    public function getOpportunities(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'need_type_id' => 'nullable',
            'interest' => 'nullable',
        ]);
            
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'validator' => implode("\n", $validator->messages()->all())]);
        }
        
        $items = Opportunity::query()->active();
        
        if(isset($request->desired_investment_from) && isset($request->desired_investment_to)){
            $items = $items->where('amount_raise', '>=', $request->desired_investment_from)->where('amount_raise', '<=', $request->desired_investment_to);
        }
        
        
        if(isset($request->work_type)){
            $items = $items->where('work_type', $request->work_type);
        }
        
        if(isset($request->need_type_id)){
            if($request->need_type_id > 0){
                $items = $items->where('fund_type_id', $request->need_type_id);
            }
        }
        
        
        if(isset($request->interest)){
            if($request->interest > 0){
                $items = $items->where('interest', $request->interest);
            }
        }

        $items = $items->latest('id')->get();
        
        $thisResponse = (object)[
            'items' => $items,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }
    
    
    
    
    public function filterOpportunities(Request $request)
    {
        
        $items = Opportunity::query();
        
        if(isset($request->desired_investment_from) && isset($request->desired_investment_to)){
            $items = $items->where('amount_raise', '>=', $request->desired_investment_from)->where('amount_raise', '<=', $request->desired_investment_to);
        }
        
        if(isset($request->work_type)){
            $items = $items->where('work_type', $request->work_type);
        }
        
        if(isset($request->level_of_difficulty)){
            $items = $items->where('level_of_difficulty', $request->level_of_difficulty);
        }
        
        if(isset($request->amount_of_technology)){
            $items = $items->where('amount_of_technology', $request->amount_of_technology);
        }
        
        $items = $items->latest('id')->get();
        
        $thisResponse = (object)[
            'items' => $items,
        ];
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $thisResponse ]);
    }
    
    
    
    
    
    public function getOpportunityDetails(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'opportunity_id' => 'required',
        ]);
            
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'validator' => implode("\n", $validator->messages()->all())]);
        }
        
        $item = Opportunity::where('id', $request->opportunity_id)->first();
        
        $item->general = $item->general;
        
        foreach($item->general as $one){
            $one->items = $one->items;
            
            foreach($one->items as $itm){
                $itm->childs = $itm->childs;
            }
        }
        
        
        
        
        $item->specific = $item->specific;
        

        foreach($item->specific as $one){
            
            if($one->type == 'financial_models'){
                $one->items = $one->items;
                // $one->childs = $one->childs;
                
                foreach($one->items as $itm){
                    $itm->childs = $itm->childs;
                }
            }

            
            if($one->type == 'business_plans'){
                $one->items = $one->items;
                // return $one->items;
                // $one->childs = $one->childs;
              
                foreach($one->items as $itm){
                    $itm->childs = $itm->childs;
                }
            }
            
            
            
            if($one->type == 'websites'){
                $one->items = $one->items;
                // $one->childs = $one->childs;
              
                foreach($one->items as $itm){
                    $itm->childs = $itm->childs;
                }
            }
            
            
            
            // if($one->type == 'websites'){
            //     // foreach($one->childs as $child){
            //     // }
                
            //     // foreach($one->childs as $child){
            //     //     $child->items = OpportunitySpecificItem::where('opportunity_specific_id', $child->id)->get();
            //     // }
                
            //     // return $one->childs;
                

            //     $one->childs = $one->childs;
            // }
            
            
            
        }
        
    

        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'data' => $item ]);
    }
    





    
    




    public function getGoals()
    {
        $active_goals = Goal::active()->where('active', 'yes')->get();
        $past_goals = Goal::active()->where('active', 'no')->get();
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'active_goals' => $active_goals,  'past_goals' => $past_goals]);
    }


    public function getLessons()
    {
        $lessons = Lesson::active()->get();
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'lessons' => $lessons ]);
    }






    // public function userHomeScreen(Request $request)
    // {

    //     $categories = Category::query();
        
    //     if($request->get('txt')){
    //         $categories = $categories->whereTranslationLike('name', '%' . $request->get('txt') . '%');
    //     }
        
    //     $categories = $categories->active()->take(2)->get();


    //     $resources = Resource::query();
    //     if($request->get('txt')){
    //         $resources = $resources->whereTranslationLike('name', '%' . $request->get('txt') . '%');
    //     }
    //     $resources = $resources->active()->take(2)->get();

        
    //     $myTasks = Task::query();
    //     if($request->get('txt')){
    //         $myTasks = $myTasks->where('title', 'LIKE', '%'. $request->txt .'%');
    //     }
        
        
    //     $myTasks = $myTasks->where('user_id', auth('api')->id())->latest('id')->take(3)->get();
        
        
        
    //     $tasksCount = Task::where('user_id', auth('api')->id())->count();
        
    //     return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'categories' => $categories, 'myTasks' => $myTasks, 'tasksCount' => $tasksCount, 'resources' => $resources]);
    // }
    
    
    
    public function markTaskDone(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'task_id' => 'required',
        ]);
            
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'validator' => implode("\n", $validator->messages()->all())]);
        }
        
        $checkTask = Task::where('id', $request->task_id)->first();
        $checkTask->update(['done' => 'yes']);
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'checkTask' => $checkTask ]);
    }





















    





    public function getSubCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);
            
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'validator' => implode("\n", $validator->messages()->all())]);
        }

        $sub_categories = Category::where('parent_id', $request->category_id)->where('approve', 'yes')->without('childs')->get();
        
        return response()->json(['status' => true, 'code' => 200, 'message' => __('api.ok'), 'sub_categories' => $sub_categories ]);
    }
    
  
 
    
    
 



    
    

  
 

    

    
 


    
    



    


    
    




 


}







