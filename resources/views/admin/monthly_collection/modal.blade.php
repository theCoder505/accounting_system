@extends('admin.layouts.app')
<meta name="csrf-token" content="{{csrf_token()}}">
@section('content')

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Total months are less than 12!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- Additional buttons if needed -->
            </div>
        </div>
    </div>
</div>


@include('admin.layouts.js_script_backend')
<!-- Trigger the modal automatically -->
<script>
    $(document).ready(function(){
        $('#myModal').modal('show');
    });
</script>

@endsection