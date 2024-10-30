import {successAlert, errorAlert, questionAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate} from "../helper/validators.js";

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
        questionAlert("Simpan Data?", "Pastikan semua data telah diisi dengan benar!", "Ya, Simpan", () => {
            axios.post(`/tools/addTool`, {
                'name': name.value,
                'description': description.value,
                'type': type.value,
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert("Data berhasil disimpan!", response.data.redirect_url);
                    } else {
                        errorAlert(response.data.message);
                    }
                })
                .catch(error => {
                    errorAlert(error.message);
                });
        })

    }
});
