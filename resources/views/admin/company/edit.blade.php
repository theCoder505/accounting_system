
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
                            <div class="card-header" style="text-align: right">
                                <h3 class="card-title">Update Customer</h3>
                                <a href="{{route('company.index')}}" class="btn btn-success"> + Add New </a>
                              </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <form action="{{route('company.update',$data->id)}}" method="post"  enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf

                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{$data->name}}">
                                                </div>
                                            </div>
                                            
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Phone Number</label>
                                                    <input type="text" name="phone" class="form-control" value="{{$data->phone}}">
                                                </div>
                                            </div>
                                            
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> Address</label>
                                                    <input type="text" name="address" class="form-control" value="{{$data->address}}">
                                                </div>
                                            </div>
                                          
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> Occupation </label>
                                                    <input type="text" name="occupation" value="{{$data->occupation}}" class="form-control">
                                                </div>
                                            </div>
                                         
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> Logo</label>
                                                    @if(isset($data))
                                                        <div class="form-group">
                                                            <img src="{{ asset($data->image) }}" alt="{{$data->title}}" style="width: 40%; margin-top: 8px">
                                                            <input type="hidden" name="old_image" value="{{ $data->image }}">
                                                        </div>
                                                        @endif
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                            </div>
                                         
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> Password </label>
                                                    <input type="text" name="password" class="form-control" value="{{ $data->password_str }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
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
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->