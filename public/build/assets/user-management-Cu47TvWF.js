document.addEventListener("DOMContentLoaded",function(){const d=document.getElementById("search-input"),i=document.getElementById("create-user-button"),l=document.querySelectorAll(".tab"),u=document.getElementById("user-table-container");let n="all",a=1,s="";function o(r="all",e=1,t=""){const p=`/api/users?role=${r}&page=${e}&search=${t}`;fetch(p,{headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(c=>c.json()).then(c=>{b(c)}).catch(c=>{console.error("Error fetching users:",c)})}function b(r){let e=`
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b"></th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Role</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Organization</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
        `;r.users.forEach(t=>{e+=`
                <tr>
                    <td class="border px-4 py-2">
                        <img class="w-10 h-10 rounded-pill object-cover" src="https://ui-avatars.com/api/?background=random&rounded=true&name=${t.name}" alt="${t.name}">
                    </td>
                    <td class="py-2 px-4 border">${t.name}</td>
                    <td class="py-2 px-4 border">${t.email}</td>
                    <td class="py-2 px-4 border text-center">${t.role_name}</td>
                    <td class="py-2 px-4 border text-center">${t.status?"✅ Active":"❌ Suspended"}</td>
                    <td class="py-2 px-4 border text-center">${t.organization_id!==null?t.organization.name:"ไม่มีสังกัด"}</td>
                    <td class="py-2 px-4 border text-end">
                        <button class="bg-yellow-100 text-black px-2 py-1 rounded mr-2" onclick="editUser(${t.id})">Edit</button>
                        <button class="bg-red-100 text-black px-2 py-1 rounded mr-2" onclick="deleteUser(${t.id})">Delete</button>
                        <button class="bg-blue-100 text-black px-2 py-1 rounded mr-2" onclick="resetPassword(${t.id})">Reset Password</button>
                        <button class="bg-gray-100 text-black px-2 py-1 rounded" onclick="suspendUser(${t.id})">${t.is_suspended?"Unsuspend":"Suspend"}</button>
                    </td>
                </tr>
            `}),e+=`
                </tbody>
            </table>
            <div class="mt-4">
                ${h(r.pagination)}
            </div>
        `,u.innerHTML=e}function h(r){let e='<div class="flex justify-center">';for(let t=1;t<=r.total_pages;t++)e+=`
                <button class="px-3 py-1 mx-1 ${t===r.current_page?"bg-blue-500 text-white":"bg-gray-200"} rounded" onclick="changePage(${t})">${t}</button>
            `;return e+="</div>",e}window.changePage=function(r){a=r,o(n,a,s)},d.addEventListener("input",function(){s=d.value,o(n,1,s)}),i.addEventListener("click",function(){window.location.href="/users/create"}),l.forEach(r=>{r.addEventListener("click",function(e){e.preventDefault(),l.forEach(t=>t.classList.remove("active")),this.classList.add("active"),n=this.getAttribute("data-role"),o(n,1,s)})}),window.editUser=function(r){window.location.href=`/users/${r}/edit`},window.deleteUser=function(r){confirm("Are you sure you want to delete this user?")&&fetch(`/users/${r}`,{method:"DELETE",headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{alert(e.message),o(n,a,s)}).catch(e=>{console.error("Error deleting user:",e)})},window.resetPassword=function(r){confirm("Are you sure you want to reset the password for this user?")&&fetch(`/users/${r}/reset-password`,{method:"POST",headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{alert(e.message)}).catch(e=>{console.error("Error resetting password:",e)})},window.suspendUser=function(r){confirm("Are you sure you want to suspend/unsuspend this user?")&&fetch(`/users/${r}/suspend`,{method:"POST",headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{alert(e.message),o(n,a,s)}).catch(e=>{console.error("Error suspending user:",e)})},o(n,a,s)});
