document.addEventListener('DOMContentLoaded', function() {
    const userData = [
        {id: 1, name: 'John Doe', score: 95, activities: 'Logged in, Completed a task', timestamp: '2024-07-04 10:30'},
        {id: 2, name: 'Jane Smith', score: 88, activities: 'Logged in, Viewed a document', timestamp: '2024-07-04 10:45'},
        // Add more mock data here
    ];

    const tableBody = document.getElementById('userTableBody');
    userData.forEach(user => {
        const row = document.createElement('tr');
        row.classList.add('odd:bg-white', 'even:bg-gray-100');
        row.innerHTML = `
            <td class="py-2 px-4 border-b">${user.id}</td>
            <td class="py-2 px-4 border-b">${user.name}</td>
            <td class="py-2 px-4 border-b">${user.score}</td>
            <td class="py-2 px-4 border-b">${user.activities}</td>
            <td class="py-2 px-4 border-b">${user.timestamp}</td>
            <td class="py-2 px-4 border-b">
                <button onclick="viewDetails(${user.id})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                    View
                </button>
            </td>
        `;
        tableBody.appendChild(row);
    });
});

function viewDetails(id) {
    alert('View details for user ID: ' + id);
}

function exportTableToCSV(filename) {
    const csv = [];
    const rows = document.querySelectorAll('table tr');
    
    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        cols.forEach(col => rowData.push(col.innerText));
        csv.push(rowData.join(','));
    });

    downloadCSV(csv.join('\n'), filename);
}

function downloadCSV(csv, filename) {
    const csvFile = new Blob([csv], { type: 'text/csv' });
    const downloadLink = document.createElement('a');
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = 'none';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}