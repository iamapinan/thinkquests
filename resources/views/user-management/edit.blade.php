<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit user') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <form action="{{ route('user.store') }}" method="POST" class="md:w-1/2 sm:w-full mx-auto">
            @csrf
            <div class="mb-4">
                <label class="block mb-2">Name</label>
                <input type="text" name="name" required value="{{$user->name}}" class="border rounded w-full px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-2">Email</label>
                <input type="email" name="email" value="{{$user->email}}" disabled class="border rounded w-full px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-2">Password</label>
                <input type="password" name="password" class="border rounded w-full px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-2">Role</label>
                <select name="role" required class="border rounded w-full px-4 py-2">
                    <option value="">เลือกสิทธิ</option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
            <x-primary-button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">บันทึก</x-primary-button>
            <x-link-button href="/user-management">ยกเลิก</x-link-button>
        </form>
    </div>
</x-app-layout>
