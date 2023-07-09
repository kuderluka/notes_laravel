<?php
    foreach($entries as $entry) { ?>
        <label for="{{$name}}[]"> <?php echo $entry[$property]?> </label>
        <input type="checkbox" name="{{$name}}[]" value="<?php echo $entry['id']?>" <?php echo (in_array($entry[$property], $checkedEntries) ? 'checked' : '')  ?>>
        <br>
    <?php }
