@props(['content_id'])

<div class="container mx-auto">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4 flex flex-rows align-middle"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
          </svg>
           &nbsp;เครื่องมือสร้างแบบทดสอบ</h1>
        <form id="quiz-form" enctype="multipart/form-data">
            <input type="hidden" value="{{ $content_id }}" name="content_id" />
            <div class="question-placeholder text-lg font-bold text-center flex flex-rows items-center justify-center rounded">
                ยังไม่มีคำถาม
            </div>
            <div id="questions-container" class="space-y-4 mb-6">
            </div>
            <div id="action-buttons-container" class="flex flex-rows items-start justify-start">
                
                <x-secondary-button type="button" id="add-mc-question" class="md:mx-1 px-4 py-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
                    </svg>&nbsp;
                  คำถามปรนัย
                </x-secondary-button>
                  
                <x-primary-button type="submit" class="px-4 py-2 md:mx-1 rounded"><svg class="w-[16px] h-[16px] text-white-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M11 16h2m6.707-9.293-2.414-2.414A1 1 0 0 0 16.586 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.414a1 1 0 0 0-.293-.707ZM16 20v-6a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v6h8ZM9 4h6v3a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4Z"/>
                  </svg>&nbsp;
                  บันทึก</x-primary-button>
            </div>
        </form>
    </div>
</div>
