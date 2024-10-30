import {successAlert, errorAlert, questionAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate, sliceUri} from "../helper/validators.js";

const name = document.getElementById('nama-kejuruan');
const description = document.getElementById('deskripsi-kejuruan');
const btnSimpan = document.getElementById('btn-simpan');
const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validDescription = description.nextElementSibling;
const invalidDescription = validDescription.nextElementSibling;
const regexName = /^[a-zA-Z ]+$/;
const regexDesc = /^[a-zA-Z0-9 .,]+$/;
let id = sliceUri();

axios.get(`/department/getDepartment/${id}`)
    .then(response => {
        if (response.data.success && !response.data.isEmpty) {
            name.value = response.data.department.nama;
            description.value = response.data.department.deskripsi;
        } else {
            errorAlert(response.data.message);
        }
    })
    .catch(error => {
        errorAlert(error.response);
    });

// Blur validation Event
blurValidate(name, "Nama Kejuruan", validName, invalidName, null, regexName, 50);
blurValidate(description, "Deskripsi Kejuruan", validDescription, invalidDescription, null, regexDesc, 255);

btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();
    let isValid = true;
    isValid = onSaveValidate(name, "Nama Kejuruan", validName, invalidName, null, regexName, 50) && isValid;
    isValid = onSaveValidate(description, "Deskripsi Kejuruan", validDescription, invalidDescription, null, regexDesc, 255) && isValid;
    if (isValid) {
        questionAlert("Perbarui data?", "Pastikan semua data telah diperbarui dengan benar!", "Ya, Perbarui", () => {
            axios.post(`/department/updateDepartment/${id}`, {
                'name': name.value,
                'description': description.value,
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert("Data berhasil diperbarui!", response.data.redirect_url);
                    } else if (!response.data.success) {
                        errorAlert(response.data.message);
                    }
                })
                .catch(error => {
                    errorAlert(error.message);
                });
        });
    }
});