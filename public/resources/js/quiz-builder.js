document.addEventListener("DOMContentLoaded", function () {
    const quizForm = document.getElementById("quiz-form");
    const questionsContainer = document.getElementById("questions-container");
    const questionPlaceholder = document.getElementsByClassName(
        "question-placeholder"
    )[0];
    let questionCount = 0;
    const availableNumbers = [];

    // document
    //     .getElementById("add-text-question")
    //     .addEventListener("click", function () {
    //         const questionNumber = getNextQuestionNumber();
    //         const questionElement = createTextQuestionElement(questionNumber);
    //         questionPlaceholder.style.display = "none";
    //         questionsContainer.appendChild(questionElement);
    //     });

    document
        .getElementById("add-mc-question")
        .addEventListener("click", function () {
            const questionNumber = getNextQuestionNumber();
            const questionElement =
                createMultipleChoiceQuestionElement(questionNumber);
            questionPlaceholder.style.display = "none";
            questionsContainer.appendChild(questionElement);
        });

    quizForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(quizForm);
        const quizData = processQuizData(formData);

        fetch("/quiz/store", {
            method: "POST",
            body: quizData,
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                alert(data.message);
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

    function createTextQuestionElement(questionNumber) {
        const div = document.createElement("div");
        div.className =
            "border-2 border-gray-300 bg-gray-100 p-4 rounded hover:border-2 hover:border-blue-400 hover:bg-blue-100 relative";
        div.setAttribute('data-question-number', questionNumber);
        div.innerHTML = `
            <button type="button" class="absolute top-2 right-2 text-red-500" onclick="removeQuestion(${questionNumber})">Delete</button>
            <label class="block mb-2 font-bold text-xl">คำถามที่ (อัตนัย)</label>
            <input type="text" name="question_${questionNumber}_text" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="คำถาม">
            <label class="block mb-2">อัพโหลดรูปเพื่อเป็นคำถาม</label>
            <input type="file" name="question_image_${questionNumber}_text" class="block w-full p-2 mb-2 rounded border">
            <div class="border-b border-gray-300 w-full my-6"></div>
            <label class="block mb-2 mt-8 text-weight-bold">คำตอบที่ถูกต้ออง</label>
            <input type="text" name="answer_${questionNumber}_text" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ป้อนคำตอบที่ถูกต้อง">
            <label class="block mb-2 text-weight-bold">คะแนน</label>
            <input type="number" name="score_${questionNumber}" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ป้อนคะแนน">
        `;
        return div;
    }

    function createMultipleChoiceQuestionElement(questionNumber) {
        const div = document.createElement("div");
        div.className =
            "border-2 border-gray-300 bg-gray-100 p-4 rounded hover:border-2 hover:border-blue-400 hover:bg-blue-100 relative";
        div.setAttribute('data-question-number', questionNumber);
        div.innerHTML = `
            <button type="button" class="absolute top-2 right-2 text-red-500" onclick="removeQuestion(${questionNumber})">Delete</button>
            <label class="block mb-2 font-bold text-xl">คำถาม (ปรนัย)</label>
            <input type="text" name="question_${questionNumber}_mc" class="block w-full p-2 mb-2 rounded border" placeholder="คำถามปรนัย">
            <label class="block mb-2">อัพโหลดรูปเพื่อเป็นคำถาม</label>
            <input type="file" name="question_image_${questionNumber}_mc" class="block w-full p-2 mb-2 rounded border">
            <div class="border-b border-gray-300 w-full my-6"></div>
            <label class="block mb-2 mt-8 text-weight-bold">ตัวเลือก</label>

            <input type="text" name="option_${questionNumber}_1" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ตัวเลือกที่ 1">
            <input type="file" name="option_image_${questionNumber}_1" class="block w-full p-2 mb-2 rounded border mb-2">

            <input type="text" name="option_${questionNumber}_2" class="block w-full p-2 mb-2 mt-4 rounded border-gray-300" placeholder="ตัวเลือกที่ 2">
            <input type="file" name="option_image_${questionNumber}_2" class="block w-full p-2 mb-2 rounded border mb-2">

            <input type="text" name="option_${questionNumber}_3" class="block w-full p-2 mb-2 mt-4 rounded border-gray-300" placeholder="ตัวเลือกที่ 3">
            <input type="file" name="option_image_${questionNumber}_3" class="block w-full p-2 mb-2 rounded border mb-2">

            <input type="text" name="option_${questionNumber}_4" class="block w-full p-2 mb-2 mt-4 rounded border-gray-300" placeholder="ตัวเลือกที่ 4">
            <input type="file" name="option_image_${questionNumber}_4" class="block w-full p-2 mb-2 rounded border mb-2">

            <label class="block mb-2 text-weight-bold mt-10">คำตอบที่ถูกต้อง</label>
            <input type="number" name="answer_${questionNumber}_mc" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ป้อนตัวเลือกที่ถูกต้องเป็นตัวเลข 1-4">
            <label class="block mb-2 text-weight-bold">คะแนน</label>
            <input type="number" name="score_${questionNumber}" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ป้อนคะแนนที่ได้หากตอบถูก">
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

    function processQuizData(formData) {
        const quizData = {
            questions: [],
        };

        const entries = Array.from(formData.entries());

        // Grouping by question
        const groupedQuestions = entries.reduce((acc, [key, value]) => {
            const [prefix, questionNumber, type] = key.split("_");
            if (!acc[questionNumber])
                acc[questionNumber] = { number: questionNumber };
            if (type) {
                if (type.startsWith("option")) {
                    if (!acc[questionNumber].options)
                        acc[questionNumber].options = [];
                    if (type.includes("image")) {
                        acc[questionNumber].options.push({ image: value });
                    } else {
                        acc[questionNumber].options.push({ text: value });
                    }
                } else {
                    if (type.includes("image")) {
                        acc[questionNumber][`${type}_file`] = value;
                    } else {
                        acc[questionNumber][type] = value;
                    }
                }
            }
            return acc;
        }, {});

        // Convert the grouped questions into an array
        quizData.questions = Object.values(groupedQuestions);

        return quizData;
    }
});
