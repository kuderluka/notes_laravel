<div class="container">
    <h1 class="mt-4"> Enter information about a note </h1>

    <form action="{{route('note.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($entry != NULL)
            @method('PUT')
            @php
                echo ('<input type="hidden" id="id" name="id" value="' . $entry->id .'">');
            @endphp
        @endif

        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">

        <div class="mb-3">
            <label>Choose the category:</label> <br>
            <select class="form-control select2" name="category_id" id="category_id">
                @foreach(App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @if(old('category_id', $entry?->category_id) == $category->id) selected @endif>{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category_id')
            <p>{{$message}}</p>
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
            <label for="content" class="form-label"> Content (Less than 500 characters) </label>
            <input type="text" class="form-control" name="content" value="{{old('content', $entry?->content)}}">
            @error('content')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label"> Priority (Whole numbers between 1 and 5) </label>
            <input type="number" min="1" max="5" class="form-control" name="priority" value="{{old('priority', $entry?->priority)}}">
            @error('priority')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label"> Deadline </label>
            <input type="datetime-local" class="form-control" name="deadline" value="{{old('deadline', $entry?->deadline)}}">
            @error('deadline')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label"> Tags (Less than 200 characters) </label>
            <input type="text" class="form-control" name="tags" value="{{old('tags', $entry?->tags)}}">
            @error('tags')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label> Choose the visibility: </label> <br>
            <select class="form-control select2" name="public" id="public">
                <option value="1"> Public </option>
                <option value="0"> Private </option>
            </select>
            @error('public')
            <p>{{$message}}</p>
            @enderror
        </div>

        <x-buttons path="notes.index" type="Note" ></x-buttons>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

