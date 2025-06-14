<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Todos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Create Button + Flash Message --}}
            <div class="flex justify-between items-center">
                <x-create-button href="{{ route('todo.create') }}" />
                @if (session('success'))
                    <div class="text-green-600 dark:text-green-400 text-sm font-semibold px-4 py-2 bg-green-100 dark:bg-green-800/20 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif
                 @if (session('danger'))
                    <div class="text-red-600 dark:text-red-400 text-sm font-semibold px-4 py-2 bg-red-100 dark:bg-red-800/20 rounded-md">
                        {{ session('danger') }}
                    </div>
                @endif
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3 text-center">Status</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $data)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white group">
                                        <a href="{{ route('todo.edit', $data) }}"
                                           class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                            {{ $data->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{-- 
                                            DIPERBAIKI: Menggunakan $data->category->title bukan $data->category->name 
                                            Ini akan menampilkan nama kategori dari relasi.
                                        --}}
                                        {{ $data->category->title ?? 'Uncategorized' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if (!$data->is_done)
                                            <span class="inline-flex items-center bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                On Going
                                            </span>
                                        @else
                                            <span class="inline-flex items-center bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                Done
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center items-center space-x-3">
                                            {{-- Tombol Complete/Uncomplete --}}
                                            @if (!$data->is_done)
                                                <form action="{{ route('todo.complete', $data) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="font-medium text-green-600 dark:text-green-400 hover:underline">Complete</button>
                                                </form>
                                            @else
                                                <form action="{{ route('todo.uncomplete', $data) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">Uncomplete</button>
                                                </form>
                                            @endif
                                            {{-- Tombol Delete --}}
                                            <form action="{{ route('todo.destroy', $data) }}" method="POST" class="m-0" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No todos found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- Paginasi (jika ada) --}}
            <div class="mt-4">
                {{ $todos->links() }}
            </div>

            {{-- Delete semua Completed Task --}}
            @if ($todosCompleted > 0)
                <div class="flex justify-start pt-6">
                    <form action="{{ route('todo.destroyCompleted') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all completed tasks?')">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>
                            Delete All Completed Tasks ({{ $todosCompleted }})
                        </x-danger-button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

