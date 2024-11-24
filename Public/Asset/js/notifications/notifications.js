import {questionAlert, cancelAlert, successAlert, errorAlert} from "../helper/exceptions.js";

window.deleteNotification = deleteNotification;

function deleteNotification(id) {
    questionAlert("Hapus Data?", "Data tidak bisa dikembalikan setelah dihapus!", "Ya, Hapus", () => {
        axios.delete(`/notification/delete/${id}`)
            .then(response => {
                if (response.data.success) {
                    successAlert(response.data.message, response.data.redirect);
                }
            })
            .catch(error => {
                errorAlert(error.message);
            });
    }, () => {
        cancelAlert("Data anda aman :)");
    })
}

window.searchNotifications = searchNotifications;

function searchNotifications() {
    const searchQuery = document.getElementById('searchInput').value;

    if (searchQuery === "") {
        loadAllNotifications();
        return;
    }

    axios.get('/search-notifications', {
        params: {search: searchQuery}
    })
        .then(response => {
            const notifications = response.data.notifications;
            updateTable(notifications);
        })
        .catch(error => {
            errorAlert(error.message);
        });
}

function loadAllNotifications() {
    axios.get('/notification/all')
        .then(response => {
            const notifications = response.data.notifications;
            updateTable(notifications);
        })
        .catch(error => {
            errorAlert(error.message);
        });
}

function updateTable(notifications) {
    const tableBody = document.querySelector('tbody');
    tableBody.innerHTML = "";

    if (notifications.length === 0) {
        tableBody.innerHTML = "<tr><td colspan='4' class='text-center'>Data tidak ditemukan</td></tr>";
    } else {
        notifications.forEach((row, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${row.pesan}</td>
                <td>${row.target}</td>
                <td class="d-flex row-gap-2 column-gap-2 pe-3 table-data-actions">
                    <button class="btn btn-danger d-flex align-items-center column-gap-1" onclick="deleteNotification(${row.id})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        Hapus
                    </button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    }
}

loadAllNotifications();