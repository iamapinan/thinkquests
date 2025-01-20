document.addEventListener("DOMContentLoaded",function(){const l=document.getElementById("quiz-form"),a=document.getElementById("questions-container"),c=document.getElementsByClassName("question-placeholder")[0];let s=0;const o=[];document.getElementById("add-mc-question").addEventListener("click",function(){const e=d(),t=u(e);c.style.display="none",a.appendChild(t)}),l.addEventListener("submit",function(e){e.preventDefault();const t=new FormData(l),r=new FormData;for(const[n,i]of t.entries())r.append(n,i);fetch("/content/save",{method:"POST",body:r,headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(n=>n.json()).then(n=>{console.log(n),window.location.href="/content/"+n.id}).catch(n=>{console.error("Error:",n)})});function d(){return o.length>0?o.pop():++s}document.addEventListener("click",function(e){e.target&&e.target.className=="toggle-button"&&e.target.nextElementSibling.classList.toggle("hidden")});function u(e){const t=document.createElement("div");return t.className="border-2 border-gray-300 bg-gray-100 p-4 rounded hover:border-2 hover:border-blue-400 hover:bg-blue-100 relative",t.setAttribute("data-question-number",e),t.innerHTML=`
            <button type="button" class="absolute top-2 right-2 text-red-500" onclick="removeQuestion(${e})">ลบข้อนี้</button>
            <button type="button" class="toggle-button" data-question-number="${e}">ข้อที่ (${e})</button>
            <div class="mt-6">
            <input type="text" required name="q[${e}][question_message]" value="" class="block w-full p-2 mb-2 rounded border" placeholder="คำถามปรนัย">
            <label class="block mb-2">อัพโหลดรูปเพื่อเป็นคำถาม</label>
            <input type="file" name="q[${e}][question_image]" class="block w-full p-2 mb-2 rounded border">
            <div class="border-b border-gray-300 w-full my-6"></div>
            <label class="block mb-2 mt-8 text-weight-bold">ตัวเลือก</label>

            <input type="text" name="q[${e}][options][1][text]" value="" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ตัวเลือกที่ 1">
            <input type="text" name="q[${e}][options][2][text]" value="" class="block w-full p-2 mb-2 mt-4 rounded border-gray-300" placeholder="ตัวเลือกที่ 2">

            <label class="block mb-2 text-weight-bold mt-10">คำตอบที่ถูกต้อง</label>
            <input type="number" required name="q[${e}][answer]" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ป้อนตัวเลือกที่ถูกต้องเป็นตัวเลข 1-4" value="1" >
            <label class="block mb-2 text-weight-bold">คะแนน</label>
            <input type="number" required name="q[${e}][score]" value="1" class="block w-full p-2 mb-2 rounded border-gray-300" placeholder="ป้อนคะแนนที่ได้หากตอบถูก">
            </div>
        `,t}window.removeQuestion=function(e){const t=document.querySelector(`[data-question-number="${e}"]`);t&&(t.remove(),o.push(e))}});
