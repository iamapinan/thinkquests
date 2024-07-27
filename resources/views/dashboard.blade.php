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
                            <div class="lg:w-1/4">
                                <div class="p-4 w-full rounded">
                                    <x-link-button href="/content/{{$content->id}}"  class="relative h-40 w-full mb-4 mx-auto">
                                        <img class="w-full h-full object-cover rounded"
                                                src="{{ asset('storage/' . $content->cover_image  ) }}"
                                                alt="">
                                    </x-link-button>
                                    <div class="flex mb-6 justify-between items-start">
                                        <div>
                                            <h3 class="text-sm font-bold mb-3">{{ $content->subject_topic }}</h3>
                                            <span class="text-xs text-gray-500">{{ $content->content_details }}</span>
                                        </div>
                                        @if(Auth::user()->role_id == 2)
                                            <button onclick="deletePost({{$content->id}})" class="ml-auto p-2 bg-blue-50 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                  </svg>
                                            </button>
                                        @endif
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
                            </div>
                            @endforeach
                        </div>
                    </x-container>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite(['resources/js/dashboard.js'])