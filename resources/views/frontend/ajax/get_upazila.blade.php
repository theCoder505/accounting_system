<option value="" disabled="" selected="">----উপজেলা----</option>
@foreach($upazilas as $upazila)
<option value="{{$upazila->id}}">
	@php echo $upazila->name_bn; @endphp
</option>
@endforeach
