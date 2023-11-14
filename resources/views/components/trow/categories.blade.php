<tr>
    <td>{{$entry->title}}</td>
    <td>
        @foreach($entry->users as $user)
            {{$user['username']}}
            <br>
        @endforeach
    </td>
    <td>{{$entry->color}}</td>
    <td>
        <a href="{{route('category.edit', ['category' => $entry])}}" class="btn btn-secondary">Edit</a>

        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >{{ __('Delete') }}</x-danger-button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="POST" action="{{ route('category.destroy', ['category' => $entry]) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete this category?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('You will leave the category and all of your notes connected to it will be deleted.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Delete Category') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </td>
</tr>
