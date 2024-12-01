import {blurValidate, onSaveValidate, sliceUri} from "../helper/validators.js";
import {errorAlert, questionAlert, successAlert} from "../helper/exceptions.js";

const name = document.getElementById('nama-alat');
const type = document.getElementById('tipe-alat');
const description = document.getElementById('deskripsi-alat');
const btnSimpan = document.getElementById('btn-simpan');
const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validType = type.nextElementSibling;
const invalidType = validType.nextElementSibling;
const validDescription = description.nextElementSibling;
const invalidDescription = validDescription.nextElementSibling;

const regexComb = /^[a-zA-Z0-9 ]+$/;
const regexDesc = /^[a-zA-Z0-9 .,]+$/;

let id = sliceUri();

axios.get(`/tools/${id}/data`)
    .then(response => {
        if (response.data.success) {
            name.value = response.data.tools.nama;
            type.value = response.data.tools.tipe;
            description.value = response.data.tools.deskripsi;
        } else if (response.data.success == false) {
            errorAlert(response.data.message);
        }
    })
    .catch(error => {
        errorAlert(error.response.data.message);
    });

blurValidate(name, "Nama Alat", validName, invalidName, null, regexComb, 50);
blurValidate(type, "Tipe Alat", validType, invalidType, null, regexComb, 25);
blurValidate(description, "Deskripsi Alat", validDescription, invalidDescription, null, regexDesc, 255);
btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();

    let isValid = true;

    isValid = onSaveValidate(name, "Nama Alat", validName, invalidName, null, regexComb, 50) && isValid;
    isValid = onSaveValidate(type, "Tipe Alat", validType, invalidType, null, regexComb, 25) && isValid;
    isValid = onSaveValidate(description, "Deskripsi Alat", validDescription, invalidDescription, null, regexDesc, 255) && isValid;

    if (isValid) {
        questionAlert("Perbarui Data?", "Pastikan semua data telah diperbarui dengan benar!", "Ya, Perbarui", () => {
            axios.put(`/tools/update/${id}`, {
                'name': name.value,
                'description': description.value,
                'type': type.value,
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert(response.data.message, response.data.redirect);
                    } else {
                        errorAlert(response.data.message);
                    }
                })
                .catch(error => {
                    errorAlert(error.response.data.message);
                });
        })

    }
});