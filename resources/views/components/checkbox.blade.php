@foreach($entries as $entry)
        <label for="{{$name}}[]"> {{$entry[$property]}} </label>
        <input type="checkbox" name="{{$name}}[]" value="{{$entry['id']}}" <?php if ($checkedEntries != NULL) {foreach($checkedEntries as $checked){ echo ($entry->is($checked)) ? 'checked' : '';}}?>>
        <br>
@endforeach
