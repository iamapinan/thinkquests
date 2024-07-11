document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("user-tab").addEventListener("click", function () {
        loadPermissions("user");
    });
    document
        .getElementById("teacher-tab")
        .addEventListener("click", function () {
            loadPermissions("teacher");
        });
    document.getElementById("admin-tab").addEventListener("click", function () {
        loadPermissions("admin");
    });

    tabs.forEach((tab) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();
            tabs.forEach((t) => t.classList.remove("active"));
            this.classList.add("active");
            currentRole = this.getAttribute("data-role");
            fetchUsers(currentRole, currentPage, searchQuery);
        });
    });

    function loadPermissions(role) {
        // Load permissions via API
        fetch(`/api/permissions/${role}`)
            .then((response) => response.json())
            .then((data) => {
                document.getElementById("read").checked = data.read;
                document.getElementById("upload").checked = data.upload;
                document.getElementById("delete-content").checked =
                    data.delete_content;
                document.getElementById("update").checked = data.update;
                document.getElementById("list").checked = data.list;
                document.getElementById("delete-user").checked =
                    data.delete_user;
                document.getElementById("view-activities").checked =
                    data.view_activities;
                document.getElementById("view-activities-logs").checked =
                    data.view_activities_logs;
            });
    }

    function updatePermissions() {
        const role = document
            .querySelector(".bg-gray-300.bg-blue-500")
            ?.id.split("-")[0]; // assuming one active role button
        const permissions = {
            read: document.getElementById("read").checked,
            upload: document.getElementById("upload").checked,
            delete_content: document.getElementById("delete-content").checked,
            update: document.getElementById("update").checked,
            list: document.getElementById("list").checked,
            delete_user: document.getElementById("delete-user").checked,
            view_activities: document.getElementById("view-activities").checked,
            view_activities_logs: document.getElementById(
                "view-activities-logs"
            ).checked,
        };

        fetch(`/api/permissions/${role}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify(permissions),
        })
            .then((response) => response.json())
            .then((data) => alert(data.message));
    }
});
