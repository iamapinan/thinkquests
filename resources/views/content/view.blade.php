<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex flex-rows">
            <a href="route('dashboard')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
              </svg>
            </a>
            {{ $content->subject_topic }}
        </h2>
    </x-slot>
    <div class="flex h-screen w-screen">
        <!-- Sidebar -->
        <div class="w-[25%] bg-blue-100 p-4">
            <h2 class="text-lg font-bold text-orange-500 mb-4">เมนู</h2>
            <ul>
                <li><a href="{{ route('content.tab', ['id' => $content->id, 'tab' => 'details']) }}" class="block py-2 px-4 {{ isset($tab) && $tab == 'details' ? 'bg-blue-300' : '' }}">รายละเอียด</a></li>
                <li><a href="{{ route('content.tab', ['id' => $content->id, 'tab' => 'videos']) }}" class="block py-2 px-4 {{ isset($tab) && $tab == 'videos' ? 'bg-blue-300' : '' }}">เนื้อหา</a></li>
                <li><a href="{{ route('content.tab', ['id' => $content->id, 'tab' => 'e-testing']) }}" class="block py-2 px-4 {{ isset($tab) && $tab == 'e-testing' ? 'bg-blue-300' : '' }}">แบบทดสอบ</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="w-3/4 p-4">
            @if (!isset($tab) || $tab == 'details')
                <div>
                    <div class="flex mb-4 gap-3">
                        <div class="w-1/3 flex items-center justify-center">
                            <img src="https://picsum.photos/412" alt="Content Image" class="w-full h-full object-cover">
                        </div>
                        <div class="w-2/3 pl-4 leading-8">
                            <h2 class="text-xl font-bold">เรื่อง: {{ $content->subject_topic }}</h2>
                            <p><strong>คำอธิบาย:</strong> {{ $content->content_details }}</p>
                            <p><strong>ตัวชี้วัด:</strong></p>
                            <ul class="list-disc pl-5">
                                @foreach (explode("\n", $content->content_indicators) as $indicator)
                                    <li>{{ $indicator }}</li>
                                @endforeach
                            </ul>
                            <p><strong>ระดับชั้น:</strong> {{ $content->grade }}</p>
                            <p><strong>คะแนน:</strong> {{ $content->score }}</p>
                            <p><strong>อัปเดทล่าสุด:</strong> {{ $content->updated_at }}</p>
                        </div>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">เริ่ม</button>
                </div>
            @elseif ($tab == 'videos')
                <div>
                    <h2 class="text-xl font-bold mb-4">เนื้อหา</h2>
                    <p>Video content for {{ $content->subject_topic }}.</p>
                    <!-- Add your video content here -->
                </div>
            @elseif ($tab == 'e-testing')
                <div>
                    <h2 class="text-xl font-bold mb-4">แบบทดสอบ</h2>
                    <x-quiz-player content_id="{{ $content->id }}" />
                </div>
            @endif
        </div>
    </div>
</x-app-layout>