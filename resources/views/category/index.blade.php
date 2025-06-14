<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo Categories') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            {{-- Tombol Create + Pesan Sukses --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('category.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Create New
                </a>
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

            {{-- Tabel Daftar Kategori --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left">Category Name</th>
                                <th scope="col" class="px-6 py-3 text-left">Todo Count</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('category.edit', $category) }}"
                                           class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                            {{-- DIPERBAIKI: Menampilkan 'title' bukan 'name' --}}
                                            {{ $category->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{-- Catatan: Agar ini berfungsi, pastikan Controller menggunakan withCount('todos') --}}
                                        {{ $category->todos_count }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('category.destroy', $category) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus kategori ini? Semua todo di dalamnya juga akan terhapus.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No categories found. Click 'Create New' to add one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
