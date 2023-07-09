<?php
    foreach($entries as $entry) {?>
        <label for="{{$name}}[]"> <?php echo $entry[$property]?> </label>
        <input type="checkbox" name="{{$name}}[]" value="<?php echo $entry['id'] ?>" <?php foreach($checkedEntries as $checked){ echo ($entry->is($checked)) ? 'checked' : '';}?>>
        <br>
    <?php }
