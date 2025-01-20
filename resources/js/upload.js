document.addEventListener("DOMContentLoaded", function () {
    // Function to handle image file upload and preview
    function handleImageUpload(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("image-preview");
        const errorMessage = document.getElementById("error-message");

        if (file && file.type.startsWith("image/")) {
            const img = new Image();
            img.onload = function () {
                if (img.width === 334 && img.height === 200) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const base64Image = e.target.result;
                        preview.src = base64Image;
                        preview.style.display = "block";
                        errorMessage.style.display = "none";

                        // Save the image data in the input element
                        event.target.setAttribute("data-base64-image", base64Image);
                    };
                    reader.readAsDataURL(file);
                } else {
                    resetInputField();
                    errorMessage.style.display = "block";
                }
            };
            img.src = URL.createObjectURL(file);
        } else {
            resetInputField();
            errorMessage.style.display = "none";
        }

        function resetInputField() {
            preview.style.display = "none";
            event.target.value = ""; // Reset the input field
            event.target.removeAttribute("data-base64-image");
        }
    }

    // Add change event listener to the cover file input
    document.getElementById("cover-upload").addEventListener("change", handleImageUpload);

    // Handle form submission
    const form = document.querySelector("#createContent");
    const nextStepButton = document.getElementById("nextStep");
    const eTestingCheckbox = document.getElementById("e-testing");
    const buttonText = document.getElementById('buttonText');
    const loadingText = document.getElementById('loadingText');
    const arrowIcon = document.getElementById('arrowIcon');
    const originalText = buttonText.textContent;

    // ฟังก์ชันสำหรับตรวจสอบไฟล์ที่อัพโหลด
    const validateFiles = () => {
        const cover = document.getElementById('cover-upload').files[0];
        const plan = document.querySelector('input[name="plan"]').files[0];
        const content = document.querySelector('input[name="file"]').files[0];
        
        if (!cover || !plan || !content) {
            throw new Error('กรุณาอัพโหลดไฟล์ให้ครบถ้วน');
        }

        // ตรวจสอบขนาดไฟล์
        if (cover.size > 10 * 1024 * 1024) { // 10MB
            throw new Error('ไฟล์รูปภาพต้องมีขนาดไม่เกิน 10MB');
        }
        
        if (plan.size > (plan.type === 'video/mp4' ? 100 : 10) * 1024 * 1024) {
            throw new Error('ไฟล์แผนการสอนมีขนาดเกินที่กำหนด');
        }
        
        if (content.size > (content.type === 'video/mp4' ? 100 : 10) * 1024 * 1024) {
            throw new Error('ไฟล์เนื้อหามีขนาดเกินที่กำหนด');
        }
    };

    // ฟังก์ชันสำหรับเปลี่ยนสถานะปุ่ม
    const toggleButtonState = (isLoading) => {
        const buttonText = document.getElementById('buttonText');
        const loadingText = document.getElementById('loadingText');
        
        nextStepButton.disabled = isLoading;
        
        if (isLoading) {
            buttonText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            loadingText.classList.add('flex');
        } else {
            buttonText.classList.remove('hidden');
            loadingText.classList.add('hidden');
            loadingText.classList.remove('flex');
        }
    };

    // ฟังก์ชันสำหรับแสดง error
    const showError = (message) => {
        // สร้าง toast notification
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
        toast.textContent = message;
        document.body.appendChild(toast);

        // ลบ toast หลังจาก 3 วินาที
        setTimeout(() => {
            toast.remove();
        }, 3000);
    };

    // เพิ่มฟังก์ชันสำหรับอัพเดท progress bar
    const updateProgress = (progress) => {
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const uploadProgress = document.getElementById('uploadProgress');
        
        uploadProgress.classList.remove('hidden');
        progressBar.style.width = `${progress}%`;
        progressText.textContent = `กำลังอัพโหลด: ${progress}%`;
    };

    function setLoadingState(isLoading) {
        if (isLoading) {
            nextStepButton.classList.add('button-loading');
            buttonText.textContent = 'กำลังดำเนินการ';
            nextStepButton.disabled = true;
        } else {
            nextStepButton.classList.remove('button-loading');
            buttonText.textContent = originalText;
            nextStepButton.disabled = false;
        }
    }

    nextStepButton.addEventListener("click", async function (e) {
        e.preventDefault();
        try {
            setLoadingState(true);
            const formData = new FormData(form);

            // ตรวจสอบข้อมูล
            if (!formData.get('title') || !formData.get('level') || !formData.get('category')) {
                throw new Error('กรุณากรอกข้อมูลให้ครบถ้วน');
            }

            validateFiles();

            // Append files
            document.querySelectorAll('input[type="file"]').forEach(input => {
                const inputName = input.name;
                if (input.files.length > 0) {
                    const file = input.files[0];
                    formData.append(inputName, file);
                }
            });

            // ใช้ XMLHttpRequest แทน fetch เพื่อติดตาม progress
            const xhr = new XMLHttpRequest();
            
            // จัดการ progress event
            xhr.upload.addEventListener('progress', (event) => {
                if (event.lengthComputable) {
                    const progress = Math.round((event.loaded / event.total) * 100);
                    updateProgress(progress);
                }
            });

            // สร้าง Promise สำหรับ XHR
            const uploadPromise = new Promise((resolve, reject) => {
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        const response = JSON.parse(xhr.responseText);
                        resolve(response);
                    } else {
                        reject(new Error('Upload failed'));
                    }
                };
                
                xhr.onerror = () => reject(new Error('Network error'));
                
                // เริ่มการอัพโหลด
                xhr.open('POST', '/content/store', true);
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                xhr.send(formData);
            });

            // รอการอัพโหลดเสร็จสิ้น
            const data = await uploadPromise;
            
            // ซ่อน progress bar เมื่อเสร็จสิ้น
            document.getElementById('uploadProgress').classList.add('hidden');

            // Redirect ตามเงื่อนไข
            if (eTestingCheckbox.checked && data.data.questionData) {
                window.location.href = "/quiz/builder?content_id=" + data.data.id;
            } else {
                window.location.href = "/";
            }

        } catch (error) {
            // ซ่อน progress bar เมื่อเกิดข้อผิดพลาด
            document.getElementById('uploadProgress').classList.add('hidden');
            showError(error.message);
            setLoadingState(false);
        }
    });
});