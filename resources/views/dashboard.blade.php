<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-container>
                        <section class="py-8">
                            <div class="flex flex-wrap items-center">
                                <div class="w-full lg:w-auto flex items-center mb-4 lg:mb-0">
                                    <h2 class="text-2xl font-bold">หน้าแรก</h2>
                                    <span
                                        class="inline-block py-1 px-2 ml-2 rounded-full text-xs text-white bg-blue-500">ทั้งหมด
                                        {{ $contents->count() }} รายการ
                                    </span>
                                </div>
                                <div
                                    class="w-full md:w-1/2 lg:w-auto flex px-4 mb-4 md:mb-0 md:mr-4 md:ml-auto border rounded bg-white">
                                    <input class="text-sm placeholder-gray-500 border-none" type="text"
                                        placeholder="ค้นหา...">
                                    <button class="ml-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>

                                    </button>
                                </div>
                                <a class="md:w-auto flex items-center py-2 px-4 rounded bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium"
                                    href="{{route('content.create')}}">
                                    <span class="inline-block mr-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                            class="size-4">
                                            <path
                                                d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                                        </svg>
                                    </span>
                                    <span>เนื้อหาใหม่</span>
                                </a>
                            </div>
                        </section>
                        <!-- Category -->
                        <div class="flex flex-wrap gap-3 justify-center mb-6">
                            @foreach ($contents as $content)
                            <x-link-button href="/content/{{$content->id}}" class="lg:w-1/4">
                                <div class="p-4 w-full rounded">
                                    <div class="relative h-40 w-full mb-4 mx-auto">
                                        <img class="w-full h-full object-cover rounded"
                                                src="{{ asset('storage/' . $content->cover_image  ) }}"
                                                alt="">
                                    </div>
                                    <div class="flex mb-6 justify-between items-center">
                                        <div>
                                            <h3 class="text-sm font-bold mb-3">{{ $content->subject_topic }}</h3>
                                            <span class="text-xs text-gray-500">{{ $content->content_details }}</span>
                                        </div>
                                    </div>
                                    <div class="flex mb-2 justify-between items-center">
                                        <h4 class="text-xs font-medium">หมวดหมู่</h4>
                                        <span class="inline-block py-1 px-2 rounded-full bg-green-50 text-xs text-green-500">{{$content->category_name}}</span>
                                    </div>
                                    <div class="flex mb-2 justify-between items-center">
                                        <h4 class="text-xs font-medium">ระดับชั้น</h4>
                                        <span class="text-xs text-blue-500 font-medium">{{ $content->level_name }}</span>
                                    </div>
                                    <div class="flex mb-5 justify-between items-center">
                                        <h4 class="text-xs font-medium">แก้ไขล่าสุด</h4>
                                        <span class="text-xs text-blue-500 font-medium">{{ $content->updated_at }}</span>
                                    </div>
                                </div>
                            </x-link-button>
                            @endforeach
                        </div>
                    </x-container>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>