<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User namagement') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex gap-4 mb-4 align-middle border-b border-gray-200">
            <ul class="flex w-2/6">
                <li class="-mb-px mr-1 self-end">
                    <a href="#" data-role="all"
                        class="tab active bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">ทั้งหมด</a>
                </li>
                <li class="-mb-px mr-1 self-end">
                    <a href="#" data-role="user"
                        class="tab bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">ผู้ใช้ทั่วไป</a>
                </li>
                <li class="-mb-px mr-1 self-end">
                    <a href="#" data-role="admin"
                        class="tab bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">ผู้ดูแลระบบ</a>
                </li>
            </ul>
            <div class="flex flex-rows gap-1 w-3/6 px-1">
                <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="bordered py-2 p-1 w-2/5" placeholder="เลือกไฟล์" required accept=".txt, .csv">
                    <x-secondary-button type="submit" class="px-2 py-2 rounded">นำเข้า</x-secondary-button>
                    <x-link-button href="{{ route('user.export') }}" class="inline-block px-4 py-2 rounded">ส่งออก</x-link-button>
                    <x-primary-button id="create-user-button" class="px-2 py-2 rounded">สร้างผู้ใช้ใหม่</x-primary-button>
                </form>
            </div>
            <form method="GET" action="{{ route('users') }}" class="flex flex-rows gap-1 w-fit px-1 justify-end">
                <input type="search" id="search-input" required class="border border-gray-200 rounded py-1 m-1" placeholder="🔍 ค้นหาผู้ใช้..."/>
            </form>
        </div>
        <div class="text-left text-sm my-4 text-white bg-gray-800 rounded p-2">หมายเหตุ รหัสผ่านชั่วคราวสำหรับผู้ใช้คือ "changeme" โปรดแจ้งผู้ใช้ให้เปลี่ยนรหัสผ่านเมื่อลงชื่อเข้าใช้งาน</div>

            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-500 text-white p-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <div id="user-table-container">
                <table class="min-w-full bg-white mt-4 border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2"></th>
                            <th class="py-2">Name</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Role</th>
                            <th class="py-2">organization</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border px-4 py-2">
                                    <img class="w-10 h-10 rounded-pill object-cover" src="https://ui-avatars.com/api/?background=random&rounded=true&name={{ $user->name }}" alt="{{ $user->name }}">
                                </td>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2 text-center">{{ $user->role_name }}</td>
                                <td class="border px-4 py-2 text-center">{{ $user->organization->name }}</td>
                                <td class="border px-4 py-2 text-center">{{ !$user->status ? '❌ Suspended' : '✅ Active' }}</td>
                                <td class="border px-4 py-2 text-end">
                                    <a href="{{ route('user.edit', $user->id) }}"
                                        class="bg-yellow-100 px-2 py-1 rounded">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-100 px-2 py-1 rounded">Delete</button>
                                    </form>
                                    <form action="{{ route('user.resetPassword', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="bg-blue-100 px-2 py-1 rounded">Reset
                                            Password</button>
                                    </form>
                                    <form action="{{ route('user.suspend', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-gray-100 px-2 py-1 rounded">{{ $user->suspended ? 'Unsuspend' : 'Suspend' }}</button>
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
