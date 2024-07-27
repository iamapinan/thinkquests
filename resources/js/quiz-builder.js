document.addEventListener("DOMContentLoaded", function () {
    const quizForm = document.getElementById("quiz-form");
    const questionsContainer = document.getElementById("questions-container");
    const questionPlaceholder = document.getElementsByClassName(
        "question-placeholder"
    )[0];
    let questionCount = 0;
    const availableNumbers = [];

    document.getElementById("add-mc-question")
    .addEventListener("click", function () {
        const questionNumber = getNextQuestionNumber();
        const questionElement = createMultipleChoiceQuestionElement(questionNumber);
        questionPlaceholder.style.display = "none";
        questionsContainer.appendChild(questionElement);
    }); // Add the closing bracket here

    quizForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(quizForm);

        // Create a new FormData object
        const formDataToSend = new FormData();

        // Append each key-value pair to the new FormData object
        for (const [key, value] of formData.entries()) {
            formDataToSend.append(key, value);
        }

        // Send the updated FormData to the server
        fetch("/content/save", {
            method: "POST",
            body: formDataToSend,
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // Redirect or handle response
            window.location.href = "/content/" + data.id;
        })
        .catch((error) => {
            console.error("Error:", error);
        });
    
    });

    function getNextQuestionNumber() {
        if (availableNumbers.length > 0) {
            return availableNumbers.pop();
        }
        return ++questionCount;
    }

    document.addEventListener('click', function(e) {
        if (e.target && e.target.className == 'toggle-button') {
            const questionContent = e.target.nextElementSibling;
            questionContent.classList.toggle('hidden');
        }
    });

    function createMultipleChoiceQuestionElement(questionNumber) {
        const div = document.createElement("div");
        div.className =
            "border-2 border-gray-300 bg-gray-100 p-4 rounded hover:border-2 hover:border-blue-400 hover:bg-blue-100 relative";
        div.setAttribute('data-question-number', questionNumber);
        div.innerHTML = `
            <button type="button" class="absolute top-2 right-2 text-red-500" onclick="removeQuestion(${questionNumber})">ลบข้อนี้</button>
            <button type="button" class="toggle-button" data-question-number="${questionNumber}">ข้อที่ (${questionNumber})</button>
            <div class="mt-6">
            <input type="text" required name="q[${questionNumber}][question_message]" value="" class="block w-full p-2 mb-2 rounded border" placeholder="คำถามปรนัย">
            <label class="block mb-2">อัพโหลดรูปเพื่อเป็นคำถาม</label>
            <input type="file" name="q[${questionNumber}][question_image]" class="block w-full p-2 mb-2 rounded border">
            <div class="border-b border-gray-300 w-full my-6"></div>
            <label class="block mb-2 mt-8 text-weight-bold">ตัวเลือก</label>

            <input type="text" name="q[${questionNumber}][options][1][text]" value="" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ตัวเลือกที่ 1">
            <input type="text" name="q[${questionNumber}][options][2][text]" value="" class="block w-full p-2 mb-2 mt-4 rounded border-gray-300" placeholder="ตัวเลือกที่ 2">

            <label class="block mb-2 text-weight-bold mt-10">คำตอบที่ถูกต้อง</label>
            <input type="number" required name="q[${questionNumber}][answer]" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ป้อนตัวเลือกที่ถูกต้องเป็นตัวเลข 1-4" value="1" >
            <label class="block mb-2 text-weight-bold">คะแนน</label>
            <input type="number" required name="q[${questionNumber}][score]" value="1" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ป้อนคะแนนที่ได้หากตอบถูก">
            </div>
        `;
        return div;
    }

    window.removeQuestion = function(questionNumber) {
        const questionElement = document.querySelector(`[data-question-number="${questionNumber}"]`);
        if (questionElement) {
            questionElement.remove();
            availableNumbers.push(questionNumber);
        }
    };
});
