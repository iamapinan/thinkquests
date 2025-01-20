document.addEventListener("DOMContentLoaded",function(){const d=[{id:1,name:"John Doe",score:95,activities:"Logged in, Completed a task",timestamp:"2024-07-04 10:30"},{id:2,name:"Jane Smith",score:88,activities:"Logged in, Viewed a document",timestamp:"2024-07-04 10:45"}],o=document.getElementById("userTableBody");d.forEach(e=>{const t=document.createElement("tr");t.classList.add("odd:bg-white","even:bg-gray-100"),t.innerHTML=`
            <td class="py-2 px-4 border-b">${e.id}</td>
            <td class="py-2 px-4 border-b">${e.name}</td>
            <td class="py-2 px-4 border-b">${e.score}</td>
            <td class="py-2 px-4 border-b">${e.activities}</td>
            <td class="py-2 px-4 border-b">${e.timestamp}</td>
            <td class="py-2 px-4 border-b">
                <button onclick="viewDetails(${e.id})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                    View
                </button>
            </td>
        `,o.appendChild(t)})});
