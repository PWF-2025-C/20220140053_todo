<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Category') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf

                        <!-- Input for Category Name -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Category Name
                            </label>
                            <input 
                                type="text" 
                                {{-- DIPERBAIKI: id dan name diubah menjadi "title" --}}
                                id="title" 
                                name="title" 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-indigo-500 dark:focus:border-indigo-500" 
                                {{-- DIPERBAIKI: old() juga menggunakan "title" --}}
                                value="{{ old('title') }}" 
                                required
                                autofocus {{-- Tambahan: agar kursor langsung aktif di sini --}}
                            />
                            {{-- DIPERBAIKI: @error juga mengecek "title" --}}
                            @error('title')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tombol Submit dan Batal -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('category.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
