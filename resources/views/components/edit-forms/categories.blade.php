<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Enter information about a category
            </h2> <br>

            <form action="{{route('category.store')}}" method="POST">
                @csrf
                @if($entry != NULL)
                    @method('PUT')
                    @php
                        echo ('<input type="hidden" id="id" name="id" value="' . $entry->id .'">');
                    @endphp
                @endif

                <input type="hidden" id="users" name="users" value="{{Auth::user()->id}}">

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
                    <x-input-error class="mt-2" :messages="$errors->get('color')" />
                </div>

                <x-buttons path="categories.index" type="Category" ></x-buttons>
            </form>
        </div>
    </div>
</div>
