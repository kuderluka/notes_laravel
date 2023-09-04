@foreach($entries as $entry)
        <input type="radio" name="{{$type}}" value="{{$entry['id']}}" {{($entry->is($checked)) ? 'checked' : ''}}>
        <label for="{{$type}}"> {{$entry[$property]}} </label> <br>
@endforeach
