<div class="container">
    <h1 class="mt-4"> Enter information about a category </h1> <br>

    <form action="{{route('category.store')}}" method="POST">
        @csrf
        @if($entry != NULL)
            @method('PUT')
            @php
                echo ('<input type="hidden" id="id" name="id" value="' . $entry->id .'">');
            @endphp
        @endif

        <div class="mb-3">
            <label>Choose users from the dropdown:</label><br>
            <select class="select2" name="users[]" multiple="multiple" style="width: 100%;">
                @foreach(App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" @if(in_array($user->id, old('users', $entry ? $entry->users->pluck('id')->toArray() : []))) selected @endif>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
            @error('users')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label"> Title (Between 3 and 50 characters) </label>
            <input type="text" class="form-control" name="title" value="{{old('title', $entry?->title)}}">
            @error('title')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="color" class="form-label"> Color </label>
            <input type="color" class="form-control" name="color" value="{{old('color', $entry?->color)}}">
            @error('color')
            <p>{{$message}}</p>
            @enderror
        </div>

        <x-buttons path="categories.index" type="Category" ></x-buttons>
    </form>
</div>

<script>
    // Initialize the Select2 plugin
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
