<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('แก้ไของค์กร') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <form action="{{ route('organizations.update', $organization->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4 w-full">
                <label for="name" class="block text-gray-700 font-bold mb-2">ชื่อองค์กร</label>
                <x-text-input type="text" name="name" id="name" value="{{ $organization->name }}" class="w-full" required/>
            </div>
            <x-primary-button type="submit">บันทึกแก้ไข</x-primary-button>
        </form>
    </div>

</x-app-layout>