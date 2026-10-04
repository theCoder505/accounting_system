@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Setting Section</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Site Settings</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
<!-- Main content -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Site Image ( 1200 * 600 )</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Favicon</a></li>
                <li class="nav-item"><a class="nav-link" href="#siteInfo" data-toggle="tab">Site Info</a></li>
                <li class="nav-item"><a class="nav-link" href="#socialLink" data-toggle="tab">Socail Link</a></li>
                <li class="nav-item"><a class="nav-link" href="#seo" data-toggle="tab">SEO Setting</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                  <form class="form-horizontal" action="{{route('save-logo')}}" method="post" enctype="multipart/form-data">
                      @csrf
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Site Image</label>
                      <div class="col-sm-6">
                          <img src="{{ asset($imge->logo ?? '') }}" style="height: 100%; width: 100%;"/>
                        <input type="file" name="logo" class="form-control">
                        <input type="hidden" value="{{$imge->id ?? ''}}" name="img_id" class="form-control" id="inputName">
                      </div>
                    </div>
                    <div class="form-group mt-5 row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </form>

                  <!-- /.post -->
                </div>
                <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-favicon')}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Favicon</label>
                        <div class="col-sm-6">
                            <img src="{{ asset($imge->favicon ?? '') }}" style="height: 100px; width: 100px;" />
                          <input type="file" name="fav_icon" class="form-control" id="inputName">
                            <input type="hidden" value="{{$imge->id ?? ''}}" name="fav_id" class="form-control" id="inputName">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="tab-pane" id="siteInfo">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-site-info', [$site_info->id])}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">

                        <div class="col-sm-6">
                          <label for="inputName" class="col-form-label">Site Name</label>
                            <input type="text" name="site_name" class="form-control" id="inputName" value="{{$site_info->site_name  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" id="inputName" value="{{$site_info->phone  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputName" value="{{$site_info->email  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="inputName" value="{{$site_info->address  ?? ''}}">
                        </div>

                        <div class="col-sm-12">
                            <label for="inputName" class="col-form-label">About us</label>
                            <textarea name="about_us" class="form-control summernote" id="" cols="30" rows="10">{!!$site_info->about_us!!}</textarea>
                        </div>


                        {{-- <div class="col-sm-12">
                            <label for="inputName" class="col-form-label">Privacy Policy</label>
                            <textarea name="privacy" class="form-control summernote" id="" cols="30" rows="10">{!!$site_info->privacy!!}</textarea>
                        </div>

                        <div class="col-sm-12">
                            <label for="inputName" class="col-form-label">Rules</label>
                            <textarea name="rules" class="form-control summernote" id="" cols="30" rows="10">{!!$site_info->rules!!}</textarea>
                        </div>


                        <div class="col-sm-12">
                            <label for="inputName" class="col-form-label">Contact</label>
                            <textarea name="contact" class="form-control summernote" id="" cols="30" rows="10">{!!$site_info->contact!!}</textarea>
                        </div> --}}


                        <div class="col-sm-6 mt-5"></div>
                        <div class="col-sm-6"></div>


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label"> <span class="text-danger">Google Analytics Code</span> </label>
                            <textarea name="google_anlytics_code" class="form-control" id="" cols="30" rows="10">{!!$site_info->google_anlytics_code!!}</textarea>
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label"> <span class="text-danger">Robots.txt</span></label>
                            <textarea name="robots_txt" class="form-control" id="" cols="30" rows="10">{!!$site_info->robots_txt!!}</textarea>
                        </div>

                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>

                <div class="tab-pane" id="socialLink">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-social-link', [$site_info->id])}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" id="inputName" value="{{$social_link->facebook  ?? ''}}">
                            <span style="color: red; font-size: 12px">Ex. https://www.facebook.com/mypagename/</span>
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control" id="inputName" value="{{$social_link->twitter  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" id="inputName" value="{{$social_link->linkedin  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control" id="inputName" value="{{$social_link->instagram  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Youtube</label>
                            <input type="text" name="youtube" class="form-control" id="inputName" value="{{$social_link->youtube  ?? ''}}">
                        </div>

                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>

                <div class="tab-pane" id="seo">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-seo', [$site_info->id])}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" id="inputName"  value="{{$seo->meta_title  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Meta Description</label>
                            <input type="text" name="meta_des" class="form-control" id="inputName"  value="{{$seo->meta_des  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" id="inputName"  value="{{$seo->meta_keywords  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Robots</label>
                            <input type="text" name="robots" class="form-control" id="inputName"  value="{{$seo->robots  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Canonical ( Link )</label>
                            <input type="text" name="canonical" class="form-control" id="inputName"  value="{{$seo->canonical  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Meta Image</label>
                            <input type="file" name="meta_image" class="form-control" id="inputName">
                            @if(isset($seo))
                            <div class="form-group">
                                <img src="{{ asset($seo->meta_image) }}" alt="meta_image" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_meta_image" value="{{ $seo->meta_image }}">
                            </div>
                            @endif
                        </div>

                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>

              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('script')
    @include('admin.layouts.js_script_backend')
@endsection
