<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\Admin;
use App\Models\Division;
use App\Models\Zila;
use App\Models\Upazila;
use Str;
use Session;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $adminId = Session::get('adminId');
        $admin = Admin::where('id', $adminId)->first();

        $categories = Category::where('status', 1)->get();
        $posts = Post::orderBy('id', 'desc')->where('author_id', $adminId)->where('status', 1)->get();
        return view('admin.post.index', compact('categories', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();

        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        $upazilas = Upazila::where('status', 1)->get();

        return view('admin.post.create', compact('categories', 'tags', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $adminId = Session::get('adminId');
        $admin = Admin::where('id', $adminId)->first();

        $post = new Post();
        $post->division_id = $request->division_id;
        $post->zila_id = $request->zila_id;
        $post->upazila_id = $request->upazila_id;
        $post->author_id = $adminId;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->video_link = $request->video_link;
        $post->total_view = 0;

        $image = $request->file('image');
        if($image)
        {
            $image_name=str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'images/post_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success)
            {
                $post->image = $image_url;
            }
        }

        $thumb_image = $request->file('thumb_image');
        if($thumb_image)
        {
            $image_name="thmb_".str::random(5);
            $ext = strtolower($thumb_image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'images/post_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $thumb_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(350, 230)->save();
            if($success)
            {
                $post->thumb_image = $image_url;
            }
        }
        $post->small_description = $request->small_description;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->save();

        $category_id= $request->category_id;
        if ($category_id) {
            foreach ($category_id as $key => $value ){
                $post_category = new PostCategory();
                $post_category->post_id =$post->id;
                $post_category->category_id=$value;
                $post_category->save();
            }   
        }

        $tag_id= $request->tag_id;
        if ($tag_id) {
            foreach ($tag_id as $key => $value ){
                $post_tag = new PostTag();
                $post_tag->post_id =$post->id;
                $post_tag->tag_id=$value;
                $post_tag->save();
            }   
        }

        $notification=array(
            'message' => 'Post Saved Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Post::find($id);
        $categories = Category::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();
        $post_categories = PostCategory::where('post_id', $id)->get();
        $post_tags = PostTag::where('post_id', $id)->get();

        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        $upazilas = Upazila::where('status', 1)->get();

        $adminId = Session::get('adminId');
        $admin = Admin::where('id', $adminId)->first();

        if($data->author_id == $adminId){
            return view('admin.post.edit', compact('categories', 'data', 'post_categories', 'post_tags', 'tags', 'divisions', 'zilas', 'upazilas'));
        }else{
            return redirect()->back();
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $adminId = Session::get('adminId');
        $admin = Admin::where('id', $adminId)->first();

        $post = Post::find($id);
        $post->division_id = $request->division_id;
        $post->zila_id = $request->zila_id;
        $post->upazila_id = $request->upazila_id;
        $post->author_id = $adminId;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->video_link = $request->video_link;

        $image = $request->file('image');
        if($image)
        {
            $image_name=str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'images/post_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success)
            {
                $old_image = $request->old_image;
                if (file_exists($old_image)) {
                    unlink($request->old_image);
                }

                $post->image = $image_url;
            }
        }

        $thumb_image = $request->file('thumb_image');
        if($thumb_image)
        {
            $image_name="thmb_".str::random(5);
            $ext = strtolower($thumb_image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'images/post_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $thumb_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(350, 230)->save();
            if($success)
            {

                $old_thumb_image = $request->old_thumb_image;
                if (file_exists($old_thumb_image)) {
                    unlink($request->old_thumb_image);
                }

                
                $post->thumb_image = $image_url;
            }
        }

        $post->small_description = $request->small_description;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->save();

        PostCategory::where('post_id', $id)->delete();
        $category_id= $request->category_id;
        if ($category_id) {
            foreach ($category_id as $key => $value ){
                $post_category = new PostCategory();
                $post_category->post_id =$post->id;
                $post_category->category_id=$value;
                $post_category->save();
            }   
        }

        PostTag::where('post_id', $id)->delete();
        $tag_id= $request->tag_id;
        if ($tag_id) {
            foreach ($tag_id as $key => $value ){
                $post_tag = new PostTag();
                $post_tag->post_id =$post->id;
                $post_tag->tag_id=$value;
                $post_tag->save();
            }   
        }

        $notification=array(
            'message' => 'Post Saved Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagePath = Post::select('image')->where('id', $id)->first();

        $filePath = $imagePath->image;

        if (file_exists($filePath)) {
            unlink($filePath);
            Post::where('id', $id)->delete();
        }else{
            Post::where('id', $id)->delete();
        }
        
        $notification=array(
            'message' => 'Post Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);
    }
}
