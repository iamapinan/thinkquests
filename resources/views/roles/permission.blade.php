<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Permissions for: {{ $user->name }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <form action="{{ route('roles.updatePermissions', $role) }}" method="POST">
            @csrf
            @method('POST')
            <div>
                <label>
                    <input type="checkbox" name="read" value="1" {{ $role->permissions->read ? 'checked' : '' }}>
                    Read
                </label>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="upload" value="1"
                        {{ $role->permissions->upload ? 'checked' : '' }}>
                    Upload
                </label>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="delete_content" value="1"
                        {{ $role->permissions->delete_content ? 'checked' : '' }}>
                    Delete Content
                </label>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="update" value="1"
                        {{ $role->permissions->update ? 'checked' : '' }}>
                    Update
                </label>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="list" value="1"
                        {{ $role->permissions->list ? 'checked' : '' }}>
                    List
                </label>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="delete_user" value="1"
                        {{ $role->permissions->delete_user ? 'checked' : '' }}>
                    Delete User
                </label>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="view_activities" value="1"
                        {{ $role->permissions->view_activities ? 'checked' : '' }}>
                    View Activities
                </label>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="view_activities_logs" value="1"
                        {{ $role->permissions->view_activities_logs ? 'checked' : '' }}>
                    View Activities Logs
                </label>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                Update Permissions
            </button>
        </form>
    </div>
</x-app-layout>
