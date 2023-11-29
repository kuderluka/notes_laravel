<tr>
    <td>{{$entry->user->username}}</td>
    <td>{{$entry->category->title}}</td>
    <td>{{$entry->title}}</td>
    <td>{{$entry->content}}</td>
    <td>{{$entry->priority}}</td>
    <td>{{ Carbon::parse($entry->deadline)->format('d/m/Y H:i:s') }}</td>
    <td>{{$entry->tags}}</td>
    @if($public)
        <td>
            @if ($entry->public == 1)
                Yes
            @else
                No
            @endif
        </td>
    @endif
    @if($editable)
        <td>
            <a href="{{route('note.edit', ['note' => $entry])}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>

            <x-danger-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-note-deletion')"
            >{{ __('Delete') }}</x-danger-button>

            <x-modal name="confirm-note-deletion" focusable>
                <form method="POST" action="{{ route('note.destroy', ['note' => $entry]) }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Are you sure you want to delete this note?') }}
                    </h2>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3">
                            {{ __('Delete note') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </td>
    @endif
</tr>
