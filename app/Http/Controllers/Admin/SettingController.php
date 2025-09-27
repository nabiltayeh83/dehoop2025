<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Language;

use App\Models\Setting as TargetModel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;


class SettingController extends Controller
{

  
    public function __construct()
    {
        $this->baseFolder = 'admin.settings';
        $this->indexRoute = 'admin.Setting.index';
        $this->locales = Language::all();
        view()->share(['locales' => $this->locales]);
    }
    
    
    
    public function index(Request $request)
    {
        $item = TargetModel::first();
        $thisResponse = (object)[
            'item' => $item,
        ];
        
        return view($this->baseFolder . '.createEdit', ['data' => $thisResponse]);
    }
    
    
    
    public function notifications(Request $request)
    {
        $item = TargetModel::first();
        $thisResponse = (object)[
            'item' => $item,
        ];
        
        return view($this->baseFolder . '.notifications', ['data' => $thisResponse]);
    }
    


    public function main_page_content(Request $request)
    {
        $item = TargetModel::first();
        $thisResponse = (object)[
            'item' => $item,
        ];
        
        return view($this->baseFolder . '.main_page_content', ['data' => $thisResponse]);
    }

 



    public function update(Request $request, $id)
    {
        
        $item = TargetModel::query()->findOrFail($id);
        $item->email = $request->email;
        $item->mobile = $request->mobile;
        $item->tiktok = $request->tiktok;
        $item->instagram = $request->instagram;
        $item->url = $request->url;

        $item->eur_comp_search = $request->eur_comp_search;
        $item->lux_comp_number = $request->lux_comp_number;
        $item->lux_comp_url = $request->lux_comp_url;
        $item->vat_number = $request->vat_number;
        $item->vat_url = $request->vat_url;

    
        $locales = Language::all()->pluck('code');
        
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->title = $request->get('title_' . $locale);
            $item->translateOrNew($locale)->description = $request->get('description_' . $locale);
            $item->translateOrNew($locale)->keywords = $request->get('keywords_' . $locale);
            $item->translateOrNew($locale)->address = $request->get('address_' . $locale);
        }
        
        if(isset($request->image)){
            $item->logo = uploadImage($request->image, 'settings');
        }
        
        $item->save();

        return redirect()->route($this->indexRoute)->with('status', __('translate.updatedSucc'));
    }
    
    
    
    public function updateNotifications(Request $request, $id)
    {
        
        $item = TargetModel::query()->findOrFail($id);


        $locales = Language::all()->pluck('code');
        
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->notification_title = $request->get('title_' . $locale);
        }

        $item->emails_cc = $request->emails_cc;    
        $item->order_requested = $request->order_requested;
        $item->order_driver_assigned = $request->order_driver_assigned;
        $item->order_in_progress = $request->order_in_progress;
        $item->order_done = $request->order_done;
        $item->order_cancelled = $request->order_cancelled;
        $item->save();

        return redirect()->route('admin.Setting.notifications')->with('status', __('translate.updatedSucc'));
    }
    
    
    
    public function updateMainPageContent (Request $request, $id)
    {
        
        $item = TargetModel::query()->findOrFail($id);


        $locales = Language::all()->pluck('code');
        
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->about_us_title = $request->get('about_us_title_' . $locale);
            $item->translateOrNew($locale)->why_us_title = $request->get('why_us_title_' . $locale);
            $item->translateOrNew($locale)->about_us_details = $request->get('about_us_details_' . $locale);
            $item->translateOrNew($locale)->why_us_details = $request->get('why_us_details_' . $locale);
        }
        
        $item->save();


        return redirect()->route('admin.Setting.main_page_content')->with('status', __('translate.updatedSucc'));
    }
    




}
