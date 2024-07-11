@props(['content_id', 'questions'])
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
        <x-primary-button type="button" class="btn try-again-btn" onclick="tryAgain()">ทำใหม่</x-primary-button>
        <x-secondary-button type="button" class="btn go-home-btn" onclick="goToHome()">กลับ</x-secondary-button>
    </div>
