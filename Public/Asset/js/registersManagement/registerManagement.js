import {questionAlert, errorAlert, successAlert, cancelAlert} from "../helper/exceptions.js";



window.deleteRegisterData = deleteRegisterData;

function deleteRegisterData(id) {
    questionAlert("Hapus data?", "Data tidak dapat dikembalikan setelah dihapus!", "Ya, Hapus", () => {
        axios.delete(`/registration/delete/${id}`)
            .then((response) => {
                if (response.data.success) {
                    successAlert(response.data.message, response.data.redirect);
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch((error) => {
                errorAlert(error.message);
            });
    }, () => {
        cancelAlert("Data anda aman :)")
    });
}

window.downloadBerkas = downloadBerkas;

function downloadBerkas(path, userName) {
    axios.post(`/registration/download`, {'path': path}, {responseType: 'blob'})
        .then(response => {
            const blob = new Blob([response.data], {type: 'application/zip'});
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = userName;
            document.body.appendChild(a);
            a.click();

            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.log(error);
            errorAlert(error.message);
        })
}

window.searchRegistrationData = searchRegistrationData;

function searchRegistrationData() {
    const searchQuery = document.getElementById('searchInput').value;

    if (searchQuery === "") {
        loadAllRegistration();
        return;
    }

    axios.get('/search-registration-data', {
        params: {search: searchQuery}
    })
        .then(response => {
            const registrations = response.data.registrations;
            updateTable(registrations);
        })
        .catch(error => {
            errorAlert(error.response);
        });
}

window.updateStatus = updateStatus;
function updateStatus(id){
    const status = document.getElementById(`status-pendaftaran-${id}`);
    questionAlert("Perbarui Status Pendafataran?", "Pastikan anda telah mengecek kelengkapan berkas pendaftar!", "Ya, Perbarui", () => {
        axios.put(`/registration/${id}`, {'status' : status.value})
            .then((response) => {
                if (response.data.success) {
                    successAlert(response.data.message, response.data.redirect);
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch((error) => {
                errorAlert(error.message);
            });
    });
}

function loadAllRegistration() {
    axios.get('/registration/all')
        .then(response => {
            const registrations = response.data.registrations;
            updateTable(registrations);
        })
        .catch(error => {
            errorAlert(error);
        });
}

function updateTable(registrations) {
    const tableBody = document.querySelector('tbody');
    tableBody.innerHTML = "";

    if (registrations.length === 0) {
        tableBody.innerHTML = "<tr><td colspan='8' class='text-center'>Data tidak ditemukan</td></tr>";
    } else {
        registrations.forEach((row, index) => {
            const tr = document.createElement('tr');
            const statusSelected = row.status;
            const disabledDitunda = statusSelected !== 'Ditunda' ? 'disabled' : '';

            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${row.nama_user}</td>
                <td>${row.nama_program}</td>
                <td>${row.registration_year}</td>
                <td>${row.registration_number}</td>
                <td>
                    <span class="download-link" onclick="downloadBerkas('${row.form_path}', '${row.registration_number}')">
                        Download
                    </span>
                </td>
                <td class="d-flex row-gap-2 column-gap-2 flex-wrap">
                        <div class="input-status-pendaftaran flex-grow-1">
                            <select name="status-pendaftaran" id="status-pendaftaran-${row.id}" class="form-select">
                                <option value="Ditunda" ${disabledDitunda}>Ditunda</option>
                                <option value="Diterima" ${statusSelected === 'Diterima' ? 'selected' : ''}>Diterima</option>
                                <option value="Ditolak" ${statusSelected === 'Ditolak' ? 'selected' : ''}>Ditolak</option>
                            </select>
                        </div>
                        <button class="btn btn-warning flex-grow-1 d-flex align-items-center justify-content-center column-gap-1" onclick="updateStatus(${row.id})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path
                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9" />
                                    <path fill-rule="evenodd"
                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z" />
                                </svg>Perbarui
                        </button>
                </td>
                <td class="pe-3 table-data-actions">
                    <button class="btn btn-danger d-flex align-items-center column-gap-1" onclick="deleteRegisterData(${row.id})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    Hapus</button>
                </td> 
            `;
            tableBody.appendChild(tr);
        });
    }
}

loadAllRegistration();