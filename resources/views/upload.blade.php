<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('สร้างเนื้อหา') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-8">
                        <h2 class="text-center text-2xl font-bold mb-6">สร้างเนื้อหาใหม่</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                {{-- error messgae --}}
                                <x-input-error :messages="$errors->createContent->get('title')" class="mt-2" />

                                <form class="space-y-4" id="createContent">
                                    <input type="text" name="title" placeholder="ชื่อเนื้อหา *"
                                        class="w-full p-3 border border-gray-300 rounded-lg" required>
                                    <textarea name="description" placeholder="คำอธิบายเนื้อหา *" class="w-full p-3 border border-gray-300 rounded-lg"></textarea>
                                    <textarea name="indicators" placeholder="ตัวชี้วัด *" class="w-full p-3 border border-gray-300 rounded-lg"></textarea>

                                    <div class="mb-4">
                                        <label for="level"
                                            class="block text-gray-700 font-bold mb-2">ระดับชั้น *</label>
                                        <select name="level" id="level" class="w-full border-gray-300 rounded" required>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}"
                                                    {{ old('level') == $level->id ? 'selected' : '' }}>
                                                    {{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="category"
                                            class="block text-gray-700 font-bold mb-2">หมวดหมู่ *</label>
                                        <select name="category" id="category" class="w-full border-gray-300 rounded" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" name="e_testing" id="e-testing" class="h-4 w-4">
                                        <label for="e-testing" class="text-black">มีแบบทดสอบด้วย</label>
                                    </div>
                                </form>
                            </div>
                            <div class="flex flex-col justify-start items-start space-y-4">
                                <div class="flex flex-col items-start space-y-4 w-full mb-10">
                                    <label for="cover-upload" class="block mb-2 font-medium text-gray-700">ภาพหน้าปก *
                                        (334x200)</label>
                                    <img id="image-preview" class="mb-3 w-[334px] h-[200px] object-cover rounded border"
                                        src="" alt="Image Preview" style="display: none;">
                                    <input id="cover-upload" name="cover" type="file" accept="image/png,image/jpeg"
                                        required
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p id="error-message" class="text-xs text-red-500 mt-3" style="display: none;">
                                        รูปต้องมีขนาด 334x200
                                        pixels.</p>
                                    <p class="text-xs text-gray-500 mt-3">JPG, PNG ไม่เกิน 10MB</p>
                                </div>
                                <div class="flex flex-col items-start space-y-4 w-full">
                                    <label class="block mb-2">แผนการสอน *</label>
                                    <input type="file" name="plan" accept=".pdf, .mp4" required
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="text-xs text-gray-500 mt-3">PDF ไม่เกิน 10MB หรือ MP4 ไม่เกิน 100MB</p>
                                </div>
                                <div class="flex flex-col items-start space-y-4 w-full">
                                    <label class="block mb-2">เนื้อหา Video/PDF *</label>
                                    <input type="file" name="file" accept=".pdf, .mp4" required
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="text-xs text-gray-500 mt-3">PDF ไม่เกิน 10MB หรือ MP4 ไม่เกิน 100MB</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            {{-- Progress Bar --}}
                            <div id="uploadProgress" class="hidden mb-4">
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-2">
                                    <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                                </div>
                                <p id="progressText" class="text-sm text-gray-600 dark:text-gray-400">กำลังอัพโหลด: 0%</p>
                            </div>

                            <button id="nextStep" type="button" class="w-full md:w-auto px-8 py-3 bg-blue-500 text-white rounded-lg gap-1 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
                                <span id="buttonText">ดำเนินการต่อ</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite(['resources/js/upload.js'])
