<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('สร้างองค์กรใหม่') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <form action="{{ route('organizations.store') }}" method="POST" class="flex flex-col">
        @csrf
        <x-text-input label="ชื่อองค์กร" type="text" name="name" id="name" placeholder="ชื่อองค์กร" required/>
        <div class="mt-4 gap-2">
            <x-primary-button type="submit" class="px-4 py-3">
                สร้าง
            </x-primary-button>
            <x-cancel-button href="{{ route('organizations.index') }}" class="px-4 py-3">
                ยกเลิก
            </x-cancel-button>
        </div>
    </form>
</div>
</x-app-layout>