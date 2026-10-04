<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteImage;
use Illuminate\Http\Request;

use App\Models\Siteinfo;
use App\Models\SiteSocialLink;
use App\Models\SiteSeo;
use Str;
use Image;

class SettingController extends Controller
{
    public function setting(){
        $imge = SiteImage::first();
        $site_info = Siteinfo::first();
        $social_link = SiteSocialLink::first();
        $seo = SiteSeo::first();
        return view('admin.setting.site_setting',compact('imge', 'site_info', 'social_link', 'seo'));
    }
    public function save_logo(Request $request){
        $logo = SiteImage::find($request->img_id);
        if($logo){
            $data = SiteImage::find($request->img_id);
            if($request->hasFile('logo')) {
                $image = $request->logo;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $logo_img = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->save($logo_img);
                $data->logo = asset($logo_img);
            }
            $data->save();
        }else{
            $data =new SiteImage();
            if($request->hasFile('logo')) {
                $image = $request->logo;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $logo_img = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->save($logo_img);
                $data->logo = asset($logo_img);
            }
            $data->save();
        }
        
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function save_favicon(Request $request){
        $favicon = SiteImage::find($request->fav_id);
        if($favicon){
            $fav_data = SiteImage::find($request->fav_id);
            if($request->hasFile('fav_icon')) {
                $image = $request->fav_icon;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $fav_icon = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->resize(32, 32)->save($fav_icon);
                $fav_data->favicon = asset($fav_icon);
            }
            $fav_data->save();
        }else{
            $fav_data = new SiteImage();
            if($request->hasFile('fav_icon')) {
                $image = $request->fav_icon;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $fav_icon = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->resize(32, 32)->save($fav_icon);
                $fav_data->favicon = asset($fav_icon);
            }
            $fav_data->save();
        }
        
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function save_site_info(Request $request, $id)
    {
        $data = Siteinfo::find($id);
        $data->site_name = $request->site_name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->about_us = $request->about_us;
        $data->privacy = $request->privacy;
        $data->rules = $request->rules;
        $data->contact = $request->contact;

        $data->google_anlytics_code = $request->google_anlytics_code;
        $data->robots_txt = $request->robots_txt;

        $data->save();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function save_social_link(Request $request, $id)
    {
        $data = SiteSocialLink::find($id);
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->linkedin = $request->linkedin;
        $data->instagram = $request->instagram;
        $data->youtube = $request->youtube;
        $data->save();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function save_seo(Request $request, $id)
    {
        $data = SiteSeo::find($id);
        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;
        $data->robots = $request->robots;
        $data->canonical = $request->canonical;
        $image = $request->file('meta_image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/uploads/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(800, 400)->save();
            if($success)
            {
                $old_meta_image = $request->old_meta_image;
                if (file_exists($old_meta_image)) {
                    unlink($request->old_meta_image);
                }
                $data->meta_image = $image_url;
            }
        }
        $data->save();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
