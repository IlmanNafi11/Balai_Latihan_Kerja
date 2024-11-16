import {successAlert, questionAlert, errorAlert} from "../helper/exceptions.js";
import {onSaveValidate, blurValidate, sliceUri} from "../helper/validators.js";

const name = document.getElementById('nama-gedung');
const description = document.getElementById('deskripsi-gedung');
const btnSimpan = document.getElementById('btn-simpan');

const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validDescription = description.nextElementSibling;
const invalidDescription = validDescription.nextElementSibling;
const regexName = /^[a-zA-Z0-9 ]+$/;
const regexDecrp = /^[a-zA-Z0-9 ,.]+$/;

let id = sliceUri();

axios.get(`/building/${id}/data`)
    .then(response => {
        if (response.data.success && !response.data.isEmpty) {
            name.value = response.data.buildings.nama;
            description.value = response.data.buildings.deskripsi;
        } else if (response.data.success && response.data.isEmpty) {
            errorAlert(response.data.message);
        }
    })
    .catch(error => {
        errorAlert(error.message);
    });

// Blur Validations event
blurValidate(name, "Nama Gedung", validName, invalidName, null, regexName, 50);
blurValidate(description, "Deskripsi Gedung", validDescription, invalidDescription, null, regexDecrp, 255);

btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();
    let isValid = true;
    isValid = onSaveValidate(name, "Nama Gedung", validName, invalidName, null, regexName, 50) && isValid;
    isValid = onSaveValidate(description, "Deskripsi Gedung", validDescription, invalidDescription, null, regexDecrp, 255) && isValid;
    if (isValid) {
        questionAlert("Perbarui data?", "Pastikan semua data telah diperbarui dengan benar!", "Ya, Perbarui", () => {
            axios.put(`/building/update/${id}`, {
                'name': name.value.trim(),
                'description': description.value.trim(),
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
        });
    }
});

