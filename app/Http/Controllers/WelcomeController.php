<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Siteinfo;
use App\Models\Post;
use App\Models\Product;
use App\Models\CoronaUpdate;
use App\Models\Contact;
use App\Models\Contactus;
use App\Models\SiteSeo;
use App\Models\SiteImage;
use App\Models\PostCategory;
use App\Models\Division;
use App\Models\Enquiry;
use App\Models\Review;
use App\Models\Service;
use App\Models\Work;
use App\Models\Zila;
use App\Models\Upazila;
use EasyBanglaDate\Types\BnDateTime;
use EasyBanglaDate\Types\DateTime as EnDateTime;
use DateTimeZone;
use DB;


class WelcomeController extends Controller
{
    public function index()
    {
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();

        $services = Service::where('status', 1)->get(); 
        $first_four_reviews = Review::where('status', 1)->take(4)->orderBy('id', 'asc')->get(); 
        $next_four_reviews = Review::where('status', 1)->skip(4)->take(4)->orderBy('id', 'asc')->get(); 

        return view('welcome', compact('site_info', 'site_image', 'services', 'first_four_reviews', 'next_four_reviews'));
    }

    public function works(){
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();

        $services = Service::where('status', 1)->get();

        return view('frontend.pages.works', compact('site_info', 'site_image', 'services'));
    }

    public function enquiry(){
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();

        $categories = Category::where('status', 1)->get();

        return view('frontend.pages.enquiry', compact('site_info', 'site_image', 'categories'));
    }

    public function contactus(){
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();


        return view('frontend.pages.contactus', compact('site_info', 'site_image'));
    }

    public function aboutus(){
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();

        $services = Service::where('status', 1)->get();
        $reviews = Review::where('status', 1)->orderBy('id', 'asc')->get(); 

        return view('frontend.pages.aboutus', compact('site_info', 'site_image', 'services', 'reviews'));
    }

    public function service_details($slug){
        $service = Service::where('slug', $slug)->first();
        if (!$service) {
            $service = Service::where('id', $slug)->first();
        }
        if (!$service) {
            $active_services = Service::where('status', 1)->get();
            foreach ($active_services as $s) {
                if (\Illuminate\Support\Str::slug($s->name) === $slug) {
                    $service = $s;
                    break;
                }
            }
        }

        if (!$service) {
            abort(404);
        }

        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();
        $services = Service::where('status', 1)->get();
        $works = Work::where('service_id', $service->id)->where('status', 1)->get();

        return view('frontend.pages.service_details', compact('site_info', 'site_image', 'service', 'services', 'works'));
    }

    public function submit_message(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'message' => 'required',
        ]);

        $data = new Contactus();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;
        $data->message = $request->message;
        $data->status = 0;
        $data->save();

        flash()->addSuccess('Your message submitted successful !');
        return redirect()->back();

    }


    public function submit_enquiry(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'category_id' => 'required',
            'project_details' => 'required',
        ]);

        $data = new Enquiry();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;
        $data->category_id = $request->category_id;
        $data->project_details = $request->project_details;
        $data->status = 0;
        $data->save();

        flash()->addSuccess('Your enquiry submitted successful !');
        return redirect()->back();

    }





}
