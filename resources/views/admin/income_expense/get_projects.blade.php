    
    <option value="">--- Select ---</option>
    @foreach($projects as $item)
        <option value="{{$item->id}}">{{$item->name}} </option>
    @endforeach