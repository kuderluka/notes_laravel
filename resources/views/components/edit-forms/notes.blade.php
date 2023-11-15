<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Enter information about a note
            </h2> <br>

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
                    <x-input-label for="category_id" :value="__('Choose the category:')" />
                    <select class="form-control select2 w-full block px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="category_id" id="category_id">
                        @foreach(App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" @if(old('category_id', $entry?->category_id) == $category->id) selected @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                </div>


                <div class="mb-3">
                    <x-input-label for="title" :value="__('Title (Between 3 and 50 characters)')" />
                    <x-text-input id="title" name="title" type="text" class="form-control" :value="old('title', $entry?->title)" />
                    <x-input-error :messages="$errors->get('title')" />
                </div>

                <div class="mb-3">
                    <x-input-label for="content" :value="__('Content (Less than 500 characters)')" />
                    <x-text-input id="content" name="content" type="text" class="form-control" :value="old('content', $entry?->content)" />
                    <x-input-error :messages="$errors->get('content')" />
                </div>

                <div class="mb-3">
                    <x-input-label for="priority" :value="__('Priority (Whole numbers between 1 and 5)')" />
                    <input type="number" min="1" max="5" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="priority" value="{{ old('priority', $entry?->priority) }}">
                    <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                </div>

                <div class="mb-3">
                    <label for="deadline" class="form-label"> Deadline </label>
                    <input type="datetime-local"  class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="deadline" value="{{old('deadline', $entry?->deadline)}}">
                    <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                </div>

                <div class="mb-3">
                    <x-input-label for="tags" :value="__('Tags (Less than 200 characters)')" />
                    <x-text-input id="tags" name="tags" type="text" class="form-control" :value="old('tags', $entry?->tags)" />
                    <x-input-error :messages="$errors->get('tags')" />
                </div>

                <div class="mb-3">
                    <label> Choose the visibility: </label> <br>
                    <select class='w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm' name="public" id="public">
                        <option value="1" @if(old('public', $entry?->public) == 1) selected @endif> Public </option>
                        <option value="0" @if(old('public', $entry?->public) == 0) selected @endif> Private </option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('public')" />
                </div>

                <x-buttons path="notes.index" type="Note" ></x-buttons>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

