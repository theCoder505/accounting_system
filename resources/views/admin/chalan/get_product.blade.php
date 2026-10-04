
<ul style="margin:0; padding:0;background: white;">
	@foreach($products as $item)
	<li data-id="{{$item->id}}" style="list-style: none;border: 1px solid #d5d5d5; padding: 6px; font-size: 15px;cursor: pointer;">{{ $item->name }}</li>
	@endforeach
</ul>



