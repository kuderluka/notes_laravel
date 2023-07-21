<div class="container">
    <h1 class="mt-4"> Enter information about a note </h1>

    <form action="{{route('notes.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($entry != NULL)
            @method('PUT')
            @php
                $editing = TRUE;
                echo ('<input type="hidden" id="id" name="id" value="' . $entry->id .'">');
                $checkedUser = \App\Models\User::find($entry->user);
                $checkedCategory = \App\Models\Category::find($entry->category);
            @endphp
        @else
            @php
                $editing = FALSE;
                $checkedUser = new \App\Models\User();
                $checkedCategory = new \App\Models\Category();
            @endphp
        @endif

        <div class="mb-3">
            <label> Choose the user by checking the circle in front of their name: </label> <br>
            <x-radio type="user" property="username" :entries="App\Models\User::all()" :checked="$checkedUser" />
            @error('user')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label> Choose the category by checking the circle in front of it's title: </label> <br>
            <x-radio type="category" property="title" :entries="App\Models\Category::all()" :checked="$checkedCategory" />
            @error('category')
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

        <button type="submit" class="btn btn-primary">Save Note</button>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Go Back</a>
        <a href="{{ route('/') }}" class="btn btn-secondary">Home</a>
    </form>
</div>

