document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const createUserButton = document.getElementById('create-user-button');
    const tabs = document.querySelectorAll('.tab');
    const userTableContainer = document.getElementById('user-table-container');
    let currentRole = 'all';
    let currentPage = 1;
    let searchQuery = '';

    function fetchUsers(role = 'all', page = 1, query = '') {
        const url = `/api/users?role=${role}&page=${page}&search=${query}`;
        fetch(url, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            renderUserTable(data);
        })
        .catch(error => {
            console.error('Error fetching users:', error);
        });
    }

    function renderUserTable(data) {
        let html = `
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
        `;

        data.users.forEach(user => {
            html += `
                <tr>
                    <td class="border px-4 py-2">
                        <img class="w-10 h-10 rounded-pill object-cover" src="https://ui-avatars.com/api/?background=random&rounded=true&name=${user.name}" alt="${user.name}">
                    </td>
                    <td class="py-2 px-4 border">${user.name}</td>
                    <td class="py-2 px-4 border">${user.email}</td>
                    <td class="py-2 px-4 border text-center">${user.role_name}</td>
                    <td class="py-2 px-4 border text-center">${user.status ? '✅ Active' : '❌ Suspended'}</td>
                    <td class="py-2 px-4 border text-center">${user.organization_id !== null ? user.organization.name : 'ไม่มีสังกัด'}</td>
                    <td class="py-2 px-4 border text-end">
                        <button class="bg-yellow-100 text-black px-2 py-1 rounded mr-2" onclick="editUser(${user.id})">Edit</button>
                        <button class="bg-red-100 text-black px-2 py-1 rounded mr-2" onclick="deleteUser(${user.id})">Delete</button>
                        <button class="bg-blue-100 text-black px-2 py-1 rounded mr-2" onclick="resetPassword(${user.id})">Reset Password</button>
                        <button class="bg-gray-100 text-black px-2 py-1 rounded" onclick="suspendUser(${user.id})">${user.is_suspended ? 'Unsuspend' : 'Suspend'}</button>
                    </td>
                </tr>
            `;
        });

        html += `
                </tbody>
            </table>
            <div class="mt-4">
                ${renderPagination(data.pagination)}
            </div>
        `;

        userTableContainer.innerHTML = html;
    }

    function renderPagination(pagination) {
        let html = '<div class="flex justify-center">';

        for (let i = 1; i <= pagination.total_pages; i++) {
            html += `
                <button class="px-3 py-1 mx-1 ${i === pagination.current_page ? 'bg-blue-500 text-white' : 'bg-gray-200'} rounded" onclick="changePage(${i})">${i}</button>
            `;
        }

        html += '</div>';
        return html;
    }

    window.changePage = function(page) {
        currentPage = page;
        fetchUsers(currentRole, currentPage, searchQuery);
    }

    searchInput.addEventListener('input', function() {
        searchQuery = searchInput.value;
        fetchUsers(currentRole, 1, searchQuery);
    });

    createUserButton.addEventListener('click', function() {
        window.location.href = '/users/create';
    });

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            currentRole = this.getAttribute('data-role');
            fetchUsers(currentRole, 1, searchQuery);
        });
    });

    window.editUser = function(userId) {
        window.location.href = `/users/${userId}/edit`;
    };

    window.deleteUser = function(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            fetch(`/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchUsers(currentRole, currentPage, searchQuery);
            })
            .catch(error => {
                console.error('Error deleting user:', error);
            });
        }
    };

    window.resetPassword = function(userId) {
        if (confirm('Are you sure you want to reset the password for this user?')) {
            fetch(`/users/${userId}/reset-password`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                console.error('Error resetting password:', error);
            });
        }
    };

    window.suspendUser = function(userId) {
        if (confirm('Are you sure you want to suspend/unsuspend this user?')) {
            fetch(`/users/${userId}/suspend`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchUsers(currentRole, currentPage, searchQuery);
            })
            .catch(error => {
                console.error('Error suspending user:', error);
            });
        }
    };

    fetchUsers(currentRole, currentPage, searchQuery);
});