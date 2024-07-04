<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Role permissions') }}
        </h2>
    </x-slot>
    <div class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <ul class="flex justify-start gap-1 mb-4">
            <li class="tab active bg-gray-300 py-2 px-4 rounded" data-role="user"><a href="#">User</a></li>
            <li class="tab bg-gray-300 py-2 px-4 rounded" data-role="teacher"><a href="#">Teacher</a></li>
            <li class="tab bg-gray-300 py-2 px-4 rounded" data-role="admin"><a href="#">Admin</a></li>
        </ul>
        <div id="permissions-form">
            <div class="mb-4">
                <h2 class="text-lg font-semibold mb-2">Contents</h2>
                <div>
                    <input type="checkbox" id="read" class="mr-2"><label for="read">Read</label>
                </div>
                <div>
                    <input type="checkbox" id="upload" class="mr-2"><label for="upload">Upload</label>
                </div>
                <div>
                    <input type="checkbox" id="delete-content" class="mr-2"><label for="delete-content">Delete</label>
                </div>
            </div>
            <div class="mb-4">
                <h2 class="text-lg font-semibold mb-2">Users</h2>
                <div>
                    <input type="checkbox" id="update" class="mr-2"><label for="update">Update</label>
                </div>
                <div>
                    <input type="checkbox" id="list" class="mr-2"><label for="list">List</label>
                </div>
                <div>
                    <input type="checkbox" id="delete-user" class="mr-2"><label for="delete-user">Delete</label>
                </div>
                <div>
                    <input type="checkbox" id="view-activities" class="mr-2"><label for="view-activities">View
                        activities</label>
                </div>
            </div>
            <div class="mb-4">
                <h2 class="text-lg font-semibold mb-2">Activities</h2>
                <div>
                    <input type="checkbox" id="view-activities-logs" class="mr-2"><label
                        for="view-activities-logs">View activities logs</label>
                </div>
            </div>
            <x-primary-button onclick="updatePermissions()">Update</x-primary-button>
        </div>
    </div>
</x-app-layout>

@vite(['resources/js/permission.js'])