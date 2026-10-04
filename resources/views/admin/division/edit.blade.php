
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
                                <h3 class="card-title">Update Division</h3>
                                <a href="{{route('division.index')}}" class="btn btn-success"> + Add New </a>
                              </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <form action="{{route('division.update',$data->id)}}" method="post"  enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Division Name ( EN )</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Tag Name" value="{{$data->name}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Division Name ( BN )</label>
                                                    <input type="text" name="name_bn" class="form-control" placeholder="Tag Name ( BN )" value="{{$data->name_bn}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
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