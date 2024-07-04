<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User namagement') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-between mb-4">
            <ul class="flex sm:w-full md:w-30">
                <li class="-mb-px mr-1">
                    <a href="#" data-role="all"
                        class="tab active bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">All</a>
                </li>
                <li class="-mb-px mr-1">
                    <a href="#" data-role="user"
                        class="tab bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">User</a>
                </li>
                <li class="-mb-px mr-1">
                    <a href="#" data-role="teacher"
                        class="tab bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">Teacher</a>
                </li>
                <li class="-mb-px mr-1">
                    <a href="#" data-role="admin"
                        class="tab bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">Admin</a>
                </li>
            </ul>
            <div class="mb-4 sm:w-full md:w-50 flex gap-1 justify-end">
                <form method="GET" action="{{ route('users') }}">
                    <x-text-input type="search" id="search-input" class="border rounded p-2" placeholder="Search users..."/>
                </form>
                <x-primary-button id="create-user-button" class="bg-blue-500 text-white px-4 py-2 rounded">Create User</x-primary-button>
            </div>
        </div>

            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div id="user-table-container">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2">Name</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Role</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2 text-center">{{ $user->role }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('user.edit', $user->id) }}"
                                        class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                    </form>
                                    <form action="{{ route('user.resetPassword', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Reset
                                            Password</button>
                                    </form>
                                    <form action="{{ route('user.suspend', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-gray-500 text-white px-2 py-1 rounded">{{ $user->suspended ? 'Unsuspend' : 'Suspend' }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>

</x-app-layout>
@vite(['resources/js/user-management.js'])
