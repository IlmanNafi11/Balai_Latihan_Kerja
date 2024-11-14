import {cancelAlert, errorAlert, questionAlert, successAlert} from "../helper/exceptions.js";

window.deleteUser = deleteUser;

function deleteUser(id) {
    questionAlert("Hapus Data Pengguna?", "Data termasuk akun, tidak dapat dikembalikan setelah dihapus!", "Ya, Hapus", () => {
        axios.delete(`/user/${id}`)
            .then(response => {
                if (response.data.success) {
                    successAlert("Data Berhasil dihapus!", response.data.redirect);
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch(error => {
                errorAlert(error.response.data.message);
            });
    }, () => {
        cancelAlert("Data Pengguna Aman :)")
    })
}

window.searchAdminUsers = searchAdminUsers;
window.searchPenggunaUsers = searchPenggunaUsers;

function searchAdminUsers() {
    const searchQuery = document.getElementById('searchAdminInput').value;
    if (searchQuery === "") {
        loadAdminUsers();
        return;
    }

    axios.get('/search-admin-users', {params: {search: searchQuery}})
        .then(response => {
            const users = response.data.users;
            updateTable(users, 'adminTableBody', 'main-container-table-admin');
        })
        .catch(error => {
            errorAlert(error.response);
        });
}

function searchPenggunaUsers() {
    const searchQuery = document.getElementById('searchPenggunaInput').value;
    if (searchQuery === "") {
        loadPenggunaUsers();
        return;
    }

    axios.get('/search-pengguna-users', {params: {search: searchQuery}})
        .then(response => {
            const users = response.data.users;
            updateTable(users, 'penggunaTableBody', 'main-container-table-pengguna');
        })
        .catch(error => {
            errorAlert(error.response);
        });
}

function loadAdminUsers() {
    axios.get('/user/admin')
        .then(response => {
            const users = response.data.users;
            updateTable(users, 'adminTableBody', 'main-container-table-admin');
        })
        .catch(error => {
            errorAlert(error.response);
        });
}

function loadPenggunaUsers() {
    axios.get('/user/pengguna')
        .then(response => {
            const users = response.data.users;
            updateTable(users, 'penggunaTableBody', 'main-container-table-pengguna');
        })
        .catch(error => {
            errorAlert(error.response);
        });
}

function updateTable(users, tableBodyId, mainContainerId) {
    const tableBody = document.getElementById(tableBodyId);
    tableBody.innerHTML = "";
    const mainContainer = document.getElementById(mainContainerId);
    const tblContainer = document.querySelectorAll('.main-container-table');

    if (users.length === 0) {
        tableBody.innerHTML = "<tr><td colspan='7' class='text-center'>Data tidak ditemukan</td></tr>";
        mainContainer.classList.add('flex-shrink-0');

        tblContainer.forEach((element) => {
            element.classList.add('flex-grow-1');
            element.style.flexBasis = "auto";
        });
    } else {
        tblContainer.forEach((element) => {
            element.classList.remove('flex-grow-1', 'flex-shrink-0');
            element.style.flexBasis = "calc(100% / 2)";
        });
        users.forEach((row, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${row.nama}</td>
                <td>${row.tlp}</td>
                <td>${row.email}</td>
                <td>${row.role}</td>
                <td>
                    <div class="avatar avatar-users">
                         <img class="avatar-img w-100 h-100" src="${row.profile_picture}" alt="${row.email}">
                    </div>
                </td>
                <td class="pe-3 table-data-actions">
                    <button class="btn btn-danger d-flex align-items-center column-gap-1"
                            onclick="deleteUser(${row.id})"
                            ${row.role === 'super admin' ? 'disabled' : ''}>
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

loadAdminUsers();
loadPenggunaUsers();
