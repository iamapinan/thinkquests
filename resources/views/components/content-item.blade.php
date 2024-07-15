@props(['isDraft' => '0'])
<div class="w-full lg:w-1/3 p-4">
    <div class="p-4 bg-white rounded">
        <div class="relative h-40 w-full mb-4">
            <img class="w-full h-full object-cover rounded"
                    src="https://picsum.photos/334/200"
                    alt="">
        </div>
        <div class="flex mb-6 justify-between items-center">
            <div>
                <h3 class="text-sm font-medium">ชื่อเรื่อง</h3>
                <span class="text-xs text-gray-500">คำอธิบาย</span>
            </div>
            <button class="ml-auto p-2 bg-blue-50 rounded">
                <svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.99984 9.33335C8.73622 9.33335 9.33317 8.7364 9.33317 8.00002C9.33317 7.26364 8.73622 6.66669 7.99984 6.66669C7.26346 6.66669 6.6665 7.26364 6.6665 8.00002C6.6665 8.7364 7.26346 9.33335 7.99984 9.33335Z"
                        fill="#382CDD"></path>
                    <path
                        d="M3.33333 9.33335C4.06971 9.33335 4.66667 8.7364 4.66667 8.00002C4.66667 7.26364 4.06971 6.66669 3.33333 6.66669C2.59695 6.66669 2 7.26364 2 8.00002C2 8.7364 2.59695 9.33335 3.33333 9.33335Z"
                        fill="#382CDD"></path>
                    <path
                        d="M12.6668 9.33335C13.4032 9.33335 14.0002 8.7364 14.0002 8.00002C14.0002 7.26364 13.4032 6.66669 12.6668 6.66669C11.9304 6.66669 11.3335 7.26364 11.3335 8.00002C11.3335 8.7364 11.9304 9.33335 12.6668 9.33335Z"
                        fill="#382CDD"></path>
                </svg>
            </button>
        </div>
        <div class="flex mb-2 justify-between items-center">
            <h4 class="text-xs font-medium">หมวดหมู่</h4>
            <span class="inline-block py-1 px-2 rounded-full bg-green-50 text-xs text-green-500">การอ่านและเขียน</span>
        </div>
        <div class="flex mb-2 justify-between items-center">
            <h4 class="text-xs font-medium">คะแนน</h4>
            <span class="inline-block py-1 px-2 rounded-full bg-red-50 text-xs text-red-500">10</span>
        </div>
        <div class="flex mb-2 justify-between items-center">
            <h4 class="text-xs font-medium">ระดับชั้น</h4>
            <span class="text-xs text-blue-500 font-medium">ประถม 1</span>
        </div>
        <div class="flex mb-5 justify-between items-center">
            <h4 class="text-xs font-medium">แก้ไขล่าสุด</h4>
            <span class="text-xs text-blue-500 font-medium">6 days ago</span>
        </div>
        <div class="flex items-ceenter justify-between border-t border-gray-50 pt-4 gap-2">
            @if($isDraft)
                <a class="py-2 px-3 flex flex-column w-full md:w-auto bg-blue-500 hover:bg-blue-900 rounded text-xs text-white transition duration-200"
                    href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z" clip-rule="evenodd" />
                    </svg>แก้ไข</a>
                <a class="py-2 px-3 flex flex-column bg-green-500 w-full md:w-auto hover:bg-blue-900 rounded text-xs text-white transition duration-200"
                    href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                    </svg>
                    เผยแพร่</a>
            @endif
        </div>
    </div>
</div>