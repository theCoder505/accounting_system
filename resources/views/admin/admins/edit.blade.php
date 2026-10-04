
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
                                <h3 class="card-title">Update Admin</h3>
                                <a href="{{route('admins.index')}}" class="btn btn-success"> + Add New </a>
                              </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <form action="{{route('admins.update',$data->id)}}" method="post">
                                    @method('patch')
                                    @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Role<span style="color: red">*</span></label>
                                        
                                        <select name="role_id" id="" class="form-control" required="">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" @php echo $data->role_id==$role->id?"selected":""; @endphp>{{$role->title}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Full Name" value="{{$data->name}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email"  value="{{$data->email}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Phone"  value="{{$data->phone}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Address"  value="{{$data->address}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- select -->
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
