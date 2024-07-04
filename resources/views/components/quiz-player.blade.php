@props(['content_id'])
<input type="hidden" value="{{$content_id}}" name="content_id" />
    <div class="home-box custom-box">
		<h3>คำแนะนำ</h3>
		<p>จำนวนคำถาม: <span class="total-question"></span></p>
		<p>คุณสามารถทำซ้ำได้หลายครั้ง</p>
		<p>ระบบจะทำการตรวจคำตอบและเฉยๆ พร้อมแสดงผลหลังทำแบบทดสอบเสร็จทันที</p>
		<p>คำถามเป็นแบบปรนัย</p>
		<button type="button" class="btn" onclick="startQuiz()">เริ่ม</button>
	</div>

    <div class="quiz-box custom-box hide">
        <div class="question-number">

        </div>
        <div class="question-text">

        </div>
        <div class="option-container">

        </div>
        <div class="next-question-btn">
            <button type="button" class="btn next-btn" onclick="next()">ถัดไป</button>
            <button type="button" class="btn exit-btn" onclick="quizOver()">ออก</button>
        </div>
        <div class="answers-indicator">

        </div>
    </div>
    <div class="result-box custom-box hide">
        <h1>ผลลัพธ์</h1>
        <table>
            <tr>
                <td>คำถามทั้งหมด</td>
                <td><span class="total-question"></span></td>
            </tr>
            <tr>
                <td>จำนวนที่ตอบ</td>
                <td><span class="total-attempt"></span></td>
            </tr>
            <tr>
                <td>ตอบถูก</td>
                <td><span class="total-correct"></span></td>
            </tr>
            <tr>
                <td>ตอบผิด</td>
                <td><span class="total-wrong"></span></td>
            </tr>
            <tr>
                <td>เปอร์เซ็นต์</td>
                <td><span class="percentage"></span></td>
            </tr>
            <tr>
                <td>คะแนนของคุณคือ</td>
                <td><span class="total-score"></span></td>
            </tr>
        </table>
        <button type="button" class="btn try-again-btn" onclick="tryAgain()">ทำใหม่</button>
        <button type="button" class="btn go-home-btn" onclick="goToHome()">กลับ</button>
    </div>
<script>
    const quiz = [
    {
        q:'What does HP stands for?',
        options: ['Henry Packard','Hewiit Packard','Hewlett Packard','Helson Packson'],
        answer: 2,
        topic: "computer"
    },
    {
        q:'In what year was the "@" chosen for its use in e-mail addresses?',
        options: ['1976','1980','1972','1984'],
        answer: 2,
        topic: "computer"
    },
    {
        q:'First ODI (Cricket) in India was played in Ahemadabad.',
        options: ['True','False'],
        answer: 0,
        topic: "sports"
    },
    {
        q:'Where is the headquarters of Intel located?',
        options: ['Redmond, Washington','Tucson, Arizona', 'Santa Clara, California'],
        answer: 2,
        topic: "computer"
    },
    {
        q:'Ostrich\'s eyes are smaller than its brain',
        options: ['True','False'],
        answer: 1,
        topic: 'biology'
    },
    {
        q:'How many squares are there in the following figure?',
        options: ['35','30', '50', '40'],
        answer: 3,
        img: 'img/square.png',
        topic: 'logic'
    },
    {
        q:'Count the triangles in picture below.',
        options: ['7','9', '22', '24'],
        answer: 3,
        img: 'img/triangle.png',
        topic: 'logic'
    },
    {
        q:'Windows, macOS, and Linux are examples of ________.?',
        options: ['Web browsers','Mobile devices', 'Filmy heroines', 'Operating systems'],
        answer: 3,
        topic: 'computer'
    },
    {
        q:'What does "GUI" stand for?',
        options: ['Global user index','Graphical user interface', 'Golu use iphone'],
        answer: 1,
        topic: 'computer'
    },
    {
        q:'Which among the following states is largest producer of Coffee in India?',
        options: ['Tamilnadu','Andhra Pradesh', 'Karnataka', 'Kerala'],
        answer: 2,
        topic:'geography',
    },
    {
        q:'Which among the following is India’s first Expressway?',
        options: ['Mumbai-Pune Expressway','Ahmedabad-Vadodara Expressway', 'Delhi-Gurgaon Expressway', 'Jaipur-Kishangarh Expressway'],
        answer: 0,
        topic:'geography'
    },
    {
        q:'Who were the 3 founders of Apple? Steve Jobs, Steve Wozniak, and ________.?',
        options: ['Tim Cook','Ronald Wayne', 'Sundar Pichai', 'Linus Torvalds'],
        answer: 1,
        topic: 'computer'
    },
    {
        q:'What country is home to the tallest mountain in the world, Mount Everest?',
        options: ['India','China', 'Nepal', 'Japan'],
        answer: 2,
        topic: 'geography'
    },
    {
        q:'What is the name of the highest uninterrupted waterfall in the world?',
        options: ['Niagara Falls','Vicoria Falls', 'Yosemite Falls','Angel Falls'],
        answer: 3,
        topic: 'geography'
    },
    {
        q:'What star sign would someone born on August 24th be?',
        options: ['Leo','Cancer', 'Virgo', 'Gemini'],
        answer: 2,
        topic: 'general_knowledge'
    },
    {
        q:'What geometric shape is generally used for stop signs?',
        options: ['Circle','Square','Hexagon','Octagon'],
        answer: 3,
        topic: 'general_knowledge'
    },
    {
        q:'What is the name of the largest ocean on earth?',
        options: ['Pacific Ocean','Indian Ocean', 'Atlantic Ocean', 'Arctic Ocean'],
        answer: 0,
        topic: 'geography'
    },
    {
        q:'Which is the only edible food that never goes bad?',
        options: ['Cheese','Honey', 'Sausage', 'Milk'],
        answer: 1,
        topic: 'general_knowledge'
    },
    {
        q:'Which country won the first-ever soccer World Cup in 1930?',
        options: ['Uruguay','Argentina', 'France', 'Brazil'],
        answer: 0,
        topic: 'sports'
    },
    {
        q:'Dump, floater, and wipe are terms used in which team sport?',
        options: ['Hockey','Cricket', 'Volleyball', 'Basketball'],
        answer: 2,
        topic: 'sports'
    },
    {
        q:'What is the hottest planet in the solar system??',
        options: ['Mercury','Mars', 'Jupiter', 'Venus'],
        answer: 4,
        topic: 'science'
    },
    {
        q:'Which former Doctor Who actress played the part of Nebula in ‘Avengers:Infinity War’?',
        options: ['Zoe Saldana','Karen Gillan', 'Emma Stone', 'Elizabeth Olsen'],
        answer: 1,
        topic:'geography',
    },
    {
        q:'Which among the following Union Territory of India has largest Area?',
        options: ['Delhi','Andaman & Nicobar Islands', 'Dadra & Nagar Haveli', 'Chandigarh'],
        answer: 0,
        topic:'geography',
    },
    {
        q:'Which countrys flag is this?',
        options: ['Greece','Cyprus', 'Italy'],
        answer: 1,
        img: 'img/cyprus.png',
        topic:'geography',
    },
];

const questionNumber = document.querySelector(".question-number");
const questionText = document.querySelector(".question-text");
const optionContainer = document.querySelector(".option-container");
const answersIndicatorContainer = document.querySelector(".answers-indicator");
const homeBox = document.querySelector(".home-box");
const quizBox = document.querySelector(".quiz-box");
const resultBox = document.querySelector(".result-box");
const questionLimit = 5;

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