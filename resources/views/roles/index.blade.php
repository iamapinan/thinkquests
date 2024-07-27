<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-dark">
                        <th class="py-2 px-4 border-b">Role</th>
                        <th class="py-2 px-4 border-b">Permissions</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $role->name }}</td>
                            <td class="py-2 px-4 border-b">
                                @if ($role->permissions)
                                    <ul>
                                        <li>Read: {{ $role->permissions->read ? 'Yes' : 'No' }}</li>
                                        <li>Upload: {{ $role->permissions->upload ? 'Yes' : 'No' }}</li>
                                        <li>Delete Content: {{ $role->permissions->delete_content ? 'Yes' : 'No' }}</li>
                                        <li>Update: {{ $role->permissions->update ? 'Yes' : 'No' }}</li>
                                        <li>List: {{ $role->permissions->list ? 'Yes' : 'No' }}</li>
                                        <li>Delete User: {{ $role->permissions->delete_user ? 'Yes' : 'No' }}</li>
                                        <li>View Activities: {{ $role->permissions->view_activities ? 'Yes' : 'No' }}</li>
                                        <li>View Activities Logs: {{ $role->permissions->view_activities_logs ? 'Yes' : 'No' }}</li>
                                    </ul>
                                @else
                                    <span>No permissions assigned</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('roles.permissions', $role->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit Permissions</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
