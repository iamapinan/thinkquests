@props(['content_id'])

<input type="hidden" value="{{ $content_id }}" name="content_id" />
<div class="p-8">
    <h2 class="text-center text-2xl font-bold mb-6">สร้างเนื้อหาใหม่</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            {{-- error messgae --}}
            <x-input-error :messages="$errors->createContent->get('title')" class="mt-2" />

            <form class="space-y-4" id="createContent">
                <input type="hidden" name="content_id" value="{{ $content_id }}">
                <input type="text" name="title" placeholder="ชื่อเนื้อหา"
                    class="w-full p-3 border border-gray-300 rounded-lg">
                <textarea name="description" placeholder="คำอธิบายเนื้อหา" class="w-full p-3 border border-gray-300 rounded-lg"></textarea>
                <textarea name="indicators" placeholder="ตัวชี้วัด" class="w-full p-3 border border-gray-300 rounded-lg"></textarea>
                <select name="level" class="w-full p-3 border border-gray-300 rounded-lg">
                    <option>ระดับชั้น</option>
                </select>
                <select name="category" class="w-full p-3 border border-gray-300 rounded-lg">
                    <option>หมวดหมู่</option>
                </select>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="e_testing" id="e-testing" class="h-4 w-4">
                    <label for="e-testing" class="text-black">มีแบบทดสอบด้วย</label>
                </div>
            </form>
        </div>
        <div class="flex flex-col justify-start items-start space-y-4">
            <div class="flex flex-col items-start space-y-4 w-full mb-10">
                <label for="cover-upload" class="block mb-2 font-medium text-gray-700">ภาพหน้าปก (334x200)</label>
                <img id="image-preview" class="mb-3 w-[334px] h-[200px] object-cover rounded border" src=""
                    alt="Image Preview" style="display: none;">
                <input id="cover-upload" name="cover" type="file" accept="image/png,image/jpeg" required
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p id="error-message" class="text-xs text-red-500 mt-3" style="display: none;">รูปต้องมีขนาด 334x200
                    pixels.</p>
                <p class="text-xs text-gray-500 mt-3">JPG, PNG ไม่เกิน 10MB</p>
            </div>
            <div class="flex flex-col items-start space-y-4 w-full">
                <label class="block mb-2">เนื้อหา Video/PDF</label>
                <input type="file" name="file" accept=".pdf, .mp4" required
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-500 mt-3">PDF ไม่เกิน 10MB หรือ MP4 ไม่เกิน 100MB</p>
            </div>
        </div>
    </div>
    <div class="mt-6 text-center">
        <x-primary-button id="nextStep" type="button"
            class="w-full md:w-auto px-8 py-3 bg-blue-500 text-white rounded-lg gap-1">ดำเนินการต่อ <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
              </svg>
              </x-primary-button>
    </div>
</div>
