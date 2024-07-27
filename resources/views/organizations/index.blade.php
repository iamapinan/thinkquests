<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Organizations') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <x-link-button href="{{ route('organizations.create') }}">สร้างองค์กรใหม่</x-link-button>
    @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4 mt-6">{{ session('success') }}</div>
    @endif
    <table class="table border mt-6 w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2 bg-gray-100">Name</th>
                <th class="border px-4 py-2 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organizations as $organization)
                <tr>
                    <td class="border px-4 py-2 w-3/4">{{ $organization->name }}</td>
                    <td class="border px-4 py-2 text-center">
                        <x-link-button href="{{ route('organizations.edit', $organization->id) }}" class="bg-blue-500">Edit</x-link-button>
                        <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this organization?')">
                            @csrf
                            @method('DELETE')
                            <x-secondary-button type="submit" class="bg-red-300 text-red-700 px-4 py-2">Delete</x-secondary-button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</x-app-layout>