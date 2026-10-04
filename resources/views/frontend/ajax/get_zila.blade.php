<option value="" disabled="" selected="">----জেলা----</option>
@foreach($zilas as $zila)
<option value="{{$zila->id}}">
	@php echo $zila->name_bn; @endphp
</option>
@endforeach
