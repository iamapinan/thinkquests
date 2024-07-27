<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('แก้ไขผู้ใช้') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('user.update', $user->id) }}" method="POST" class="md:w-full sm:w-full mx-auto">
            @csrf
            <div class="mb-4">
                <label class="block mb-2">ชื่อ/นามสกุล</label>
                <input type="text" name="name" required value="{{$user->name}}" class="border rounded w-full px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-2">สิทธิ</label>
                <select name="role" class="border rounded w-full px-4 py-2">
                    <option value="">เลือกสิทธิ</option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2">ตั้งรหัสผ่านใหม่ (ความยาว 8 ตัวขึ้นไป)</label>
                <input type="password" name="password" placeholder="••••••" minlength="8" class="border rounded w-full px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-2">อีเมล (ไม่สามารถแก้ไขได้)</label>
                <input type="email" disabled name="email" value="{{$user->email}}" disabled class="border border-gray-200 text-gray-500 rounded w-full px-4 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block mb-2">องค์กร (ไม่สามารถแก้ไขได้)</label>
                <input type="text" name="organization" value="{{$user->organization->name}}" disabled class="border border-gray-200 text-gray-500 rounded w-full px-4 py-2">
            </div>
            
            <x-primary-button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">บันทึก</x-primary-button>
            <x-cancel-button href="/user-management">ยกเลิก</x-cancel-button>
        </form>
    </div>
</x-app-layout>
