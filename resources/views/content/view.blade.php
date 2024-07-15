<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex flex-rows">
            <a href="{{route('dashboard')}}">
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
                <li><a href="{{ route('content.tab', ['id' => $content->id, 'tab' => 'plan']) }}" class="block py-2 px-4 {{ isset($tab) && $tab == 'plan' ? 'bg-blue-300' : '' }}">แผนการสอน</a></li>
                <li><a href="{{ route('content.tab', ['id' => $content->id, 'tab' => 'videos']) }}" class="block py-2 px-4 {{ isset($tab) && $tab == 'videos' ? 'bg-blue-300' : '' }}">เนื้อหา</a></li>
                <li><a href="{{ route('content.tab', ['id' => $content->id, 'tab' => 'e-testing']) }}" class="block py-2 px-4 {{ isset($tab) && $tab == 'e-testing' ? 'bg-blue-300' : '' }}">แบบทดสอบ</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="w-3/4 p-4">
            @if (!isset($tab) || $tab == 'details')
                <div class="mb-10">
                    <div class="flex mb-4 gap-3">
                        <div class="w-1/3 flex items-center justify-center">
                            <img src="{{ asset('storage/'.$content->cover_image) }}" alt="Content Image" class="w-full h-full object-cover">
                        </div>
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
                            <p><strong>ระดับชั้น:</strong> {{ $level->name }}</p>
                            <p><strong>หมวดหมู่:</strong> {{ $category->name }}</p>
                            <p><strong>อัปเดทล่าสุด:</strong> {{ $content->updated_at }}</p>
                        </div>
                    </div>
                    <x-link-button href="{{ route('content.tab', ['id' => $content->id, 'tab' => 'videos']) }}">เริ่ม</x-link-button>
                </div>
            @elseif ($tab == 'plan')
                <div>
                    <h2 class="text-xl font-bold mb-4">แผนการสอน</h2>
                    <div>
                        <iframe src="{{ asset('storage/'.$content->plan) }}" width="100%" style="height: 80vh;"></iframe>
                    </div>
                </div>
            @elseif ($tab == 'videos')
                <div>
                    <h2 class="text-xl font-bold mb-4">เนื้อหา</h2>
                    <div>
                        {{-- pdf embed --}}
                        @if($content->video_pdf&&explode('.',$content->video_pdf)[1]=='pdf')
                            <iframe src="{{ asset('storage/'.$content->video_pdf) }}" width="100%" style="height: 80vh;"></iframe>
                        @else
                            <video controls width="100%" style="height: 80vh;">
                                <source src="{{ asset('storage/'.$content->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
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

<script>
    const quiz = [
        @foreach($questions as $question)
            {
                q: '{{ $question->question_text }}',
                options: ['{{ $question->answer[0]['answer_text'] }}','{{ $question->answer[1]['answer_text'] }}','{{ $question->answer[2]['answer_text'] }}','{{ $question->answer[3]['answer_text'] }}'],
                answer: {{ $question->correct_choice-1 }},
                @if($question->question_image)
                    img: '{{ asset('storage/'.$question->question_image) }}',
                @endif
            },
        @endforeach
        // {
        //     q:'Which countrys flag is this?',
        //     options: ['Greece','Cyprus', 'Italy'],
        //     answer: 1,
        //     img: 'img/cyprus.png',
        //     topic:'geography',
        // },
    ];

const questionNumber = document.querySelector(".question-number");
const questionText = document.querySelector(".question-text");
const optionContainer = document.querySelector(".option-container");
const answersIndicatorContainer = document.querySelector(".answers-indicator");
const homeBox = document.querySelector(".home-box");
const quizBox = document.querySelector(".quiz-box");
const resultBox = document.querySelector(".result-box");
const questionLimit = quiz.length;

let questionCounter = 0;
let currentQuestion;
let availableQuestions = [];
let availableOptions = [];
let correctAnswers = 0;
let attempt = 0;

function setAvailableQuestions(){
    const totalQuestions = quiz.length;
    for(let i=0; i<totalQuestions; i++){
        availableQuestions.push(quiz[i])
    }
}

function getNewQuestion(){
    questionNumber.innerHTML = "คำถามที่ " + (questionCounter+1) + " จาก " + questionLimit;
    const questionIndex = availableQuestions[Math.floor(Math.random()*availableQuestions.length)];
    currentQuestion = questionIndex;
    questionText.innerHTML = currentQuestion.q;
    const index1 = availableQuestions.indexOf(questionIndex);
    availableQuestions.splice(index1,1);
    if(currentQuestion.hasOwnProperty("img")){
        const img = document.createElement("img");
        img.src = currentQuestion.img;
        questionText.appendChild(img);
    }
    const optionsLength = currentQuestion.options.length;
    for(let i=0; i<optionsLength; i++){
        availableOptions.push(i);
    }
    optionContainer.innerHTML = '';
    let animationDelay = 0.2;
    for(let i=0; i<optionsLength; i++){
        const optionIndex = availableOptions[Math.floor(Math.random()*availableOptions.length)];
        const index2 = availableOptions.indexOf(optionIndex);
        availableOptions.splice(index2,1);
        const option = document.createElement("div");
        option.innerHTML = currentQuestion.options[optionIndex];
        option.id = optionIndex;
        option.style.animationDelay = animationDelay+'s';
        animationDelay = animationDelay+0.15;
        option.className = "option";
        optionContainer.appendChild(option);
        option.setAttribute("onclick", "getResult(this)");
    }
    questionCounter++;
}

function getResult(element){
    const id = parseInt(element.id);
    if(id === currentQuestion.answer){
        element.classList.add("correct");
        updateAnswerIndicator("correct");
        correctAnswers++;
    }
    else{
        element.classList.add("wrong");
        updateAnswerIndicator("wrong");
        const optionLength = optionContainer.children.length;
        for(let i=0; i<optionLength; i++){
            if(parseInt(optionContainer.children[i].id)===currentQuestion.answer) {
                optionContainer.children[i].classList.add("correct");
            }
        }
    }
    attempt++;
    unclickableOptions();
}

function unclickableOptions(){
    const optionLength = optionContainer.children.length;
    for(let i=0; i<optionLength; i++){
        optionContainer.children[i].classList.add("already-answered");
    }
}

function next(){
    if(questionCounter === questionLimit){
        quizOver();
    }else{
        getNewQuestion()
    }
}

function answersIndicator(){
    answersIndicatorContainer.innerHTML = '';
    const totalQuestion = questionLimit;
    for(let i=0; i<totalQuestion; i++){
        const indicator = document.createElement("div");
        answersIndicatorContainer.appendChild(indicator);

    }
}

function updateAnswerIndicator(markType){
    answersIndicatorContainer.children[questionCounter-1].classList.add(markType)
}

function quizOver(){
    quizBox.classList.add("hide");
    resultBox.classList.remove("hide");
    quizResult();
}

function quizResult(){
    resultBox.querySelector(".total-question").innerHTML = questionLimit;
    resultBox.querySelector(".total-correct").innerHTML = correctAnswers;
    resultBox.querySelector(".total-attempt").innerHTML = attempt;
    resultBox.querySelector(".total-wrong").innerHTML = attempt - correctAnswers;
    const percentage = (correctAnswers/questionLimit)*100;
    resultBox.querySelector(".percentage").innerHTML = percentage.toFixed(2) + "%";
    resultBox.querySelector(".total-score").innerHTML = correctAnswers + " / " + questionLimit;
}

function resetQuiz(){
    questionCounter = 0;
    correctAnswers = 0;
    attempt = 0;
    availableQuestions = [];
}

function tryAgain(){
    resultBox.classList.add("hide");
    quizBox.classList.remove("hide");
    resetQuiz();
    startQuiz();
}

function goToHome(){
    resultBox.classList.add("hide");
    homeBox.classList.remove("hide");
    resetQuiz();
}

function startQuiz(){
    homeBox.classList.add("hide");
    quizBox.classList.remove("hide");
    setAvailableQuestions();
    getNewQuestion();
    answersIndicator();
}

window.onload = function (){
    homeBox.querySelector(".total-question").innerHTML = ""+questionLimit;
}
</script>