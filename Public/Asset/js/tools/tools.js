import {successAlert, errorAlert, questionAlert, cancelAlert} from "../helper/exceptions.js";

window.deleteTools = deleteTools;

function deleteTools(id) {
    questionAlert("Hapus Data?", "Data tidak dapat dikembalikan setelah dihapus!", "Ya Hapus", () => {
        axios.delete(`/tools/delete/${id}`)
            .then(response => {
                if (response.data.success) {
                    successAlert(response.data.message, response.data.redirect)
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch(error => {
                errorAlert(error.message);
            });
    }, () => {
        cancelAlert("Data anda aman :)")
    });
}

window.searchTools = searchTools;

function searchTools() {
    const searchQuery = document.getElementById('searchInput').value;

    if (searchQuery === "") {
        loadAllTools();
        return;
    }

    axios.get('/search-tools', {
        params: {search: searchQuery}
    })
        .then(response => {
            const tools = response.data.tools;
            updateTable(tools);
        })
        .catch(error => {
            errorAlert(error.response);
        });
}

function loadAllTools() {
    axios.get('/tools/all')
        .then(response => {
            const tools = response.data.tools;
            updateTable(tools);
        })
        .catch(error => {
            errorAlert(error.response);
        });
}

function updateTable(tools) {
    const tableBody = document.querySelector('tbody');
    tableBody.innerHTML = "";

    if (tools.length === 0) {
        tableBody.innerHTML = "<tr><td colspan='5' class='text-center'>Data tidak ditemukan</td></tr>";
    } else {
        tools.forEach((row, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${row.nama}</td>
                <td>${row.tipe}</td>
                <td>${row.deskripsi}</td>
                <td class="d-flex row-gap-2 column-gap-2 pe-3 table-data-actions">
                    <a href="/tools/update/${row.id}">
                        <button class="btn btn-warning d-flex align-items-center column-gap-1 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                            Ubah
                        </button>
                    </a>
                    <button class="btn btn-danger d-flex align-items-center column-gap-1" onclick="deleteTools(${row.id})">
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

loadAllTools();