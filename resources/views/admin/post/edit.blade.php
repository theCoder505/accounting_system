@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Edit </title>
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Post Edit Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post Edit Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Edit Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{URL::to('admin/post/'.$data->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">

                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post Title</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Post Title" value="{{$data->title}}">
                                </div>

                            	<div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>বিভাগ</label>
                                            <select class="custom-select" name="division_id" id="division_id" onchange="GetZila(this.value)" >
                                                <option value="" selected="">Select</option>
                                                @foreach($divisions as $division)
                                                <option value="{{$division->id}}" @php if ($data['division_id'] == $division->id) { echo "selected"; } @endphp>{{$division->name_bn}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>জেলা</label>
                                            <select class="custom-select" name="zila_id" id="zila" onchange="GetUpazila(this.value)">
                                                <option value="" selected="">Select</option>
                                                @foreach($zilas as $zila)
                                                    <option value="{{$zila->id}}" @php if ($data['zila_id'] == $zila->id) { echo "selected"; } @endphp>{{$zila->name_bn}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>উপজেলা</label>
                                            <select class="custom-select" name="upazila_id" id="upazila">
                                                <option value="" selected="">Select</option>
                                                @foreach($upazilas as $upazila)
                                                    <option value="{{$upazila->id}}" @php if ($data['upazila_id'] == $upazila->id) { echo "selected"; } @endphp>{{$upazila->name_bn}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


	                            	<div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Category<span style="color: red">*</span></label>
		                                    
		                                    <select name="category_id[]" id="category_id" class="form-control js-example-basic-multiple" required=""  multiple="multiple">
		                                        @foreach($categories as $category)    
                                                    @foreach($post_categories as $post_category)
		                                                <option value="{{$category->id}}" @php echo $post_category->category_id==$category->id?"selected":""; @endphp>{{$category->name}} ( {{$category->name_bn ?? '-'}} )</option>
		                                              @endforeach
                                                @endforeach
		                                    </select>
		                                </div>
	                            	</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tag<span style="color: red">*</span></label>
                                            
                                            <select name="tag_id[]" id="tag_id" class="form-control js-example-basic-multiple" required=""  multiple="multiple">
                                                @foreach($tags as $tag)    
                                                    @foreach($post_tags as $post_tag)
                                                        <option value="{{$tag->id}}" @php echo $post_tag->tag_id==$tag->id?"selected":""; @endphp>{{$tag->name}} ( {{$tag->name_bn ?? '-'}} )</option>
                                                      @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Small Description<span style="color: red">*</span></label>
                                            <textarea name="small_description" id=""  rows="3" class="form-control">{!!$data->small_description!!}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Description<span style="color: red">*</span></label>
                                            <textarea name="description" id="summernote" cols="30" rows="10" class="form-control">{!!$data->description!!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Lead Image</label>

                                            @if(isset($data))
                                            <div class="form-group">
                                                <img src="{{ asset($data->image) }}" alt="Image" style="width: 20%; margin-top: 8px">
                                                <input type="hidden" name="old_image" value="{{ $data->image }}">
                                            </div>
                                            @endif

                                            <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Thumb Image</label>

                                            @if(isset($data))
                                            <div class="form-group">
                                                <img src="{{ asset($data->thumb_image) }}" alt="thumb_image" style="width: 20%; margin-top: 8px">
                                                <input type="hidden" name="old_thumb_image" value="{{ $data->thumb_image }}">
                                            </div>
                                            @endif

                                            <input type="file" name="thumb_image" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Video Link ( Optional )</label>
                                            <input type="text" name="video_link" class="form-control" id="exampleInputEmail1"  value="{{$data->video_link}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Title<span style="color: red">*</span></label>
                                            <input type="text" name="meta_title" class="form-control" id="exampleInputEmail1" value="{{$data->meta_title}}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Keywords<span style="color: red">*</span></label>
                                            <input type="text" name="meta_keywords" class="form-control" id="exampleInputEmail1" value="{{$data->meta_keywords}}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Description<span style="color: red">*</span></label>
                                            <input type="text" name="meta_description" class="form-control" id="exampleInputEmail1" value="{{$data->meta_description}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Publication Status</label>
                                            <select class="custom-select" name="status">
                                                <option value="1" @php if ($data['status'] == 1) { echo "selected"; } @endphp>Active</option>
                                                <option value="0" @php if ($data['status'] == 0) { echo "selected"; } @endphp>Inactive</option>
                                            </select>
                                        </div>
                                    </div>


                            	</div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
@section('script')
    @include('admin.layouts.js_script_backend')
@endsection