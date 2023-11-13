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

                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $entry?->title)" required autofocus autocomplete="title" />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
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
    </div>
</div>
