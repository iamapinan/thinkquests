<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Role: {{ $user->name }}
        </h2>
    </x-slot>
    
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <form action="{{ route('roles.update', $user) }}" method="POST">
            @csrf
            @foreach($roles as $role)
                <div>
                    <label>
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                Update Roles
            </button>
        </form>
    </div>
</x-app-layout>
