import {errorAlert, questionAlert, successAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate} from "../helper/validators.js";

const name = document.getElementById('nama-kejuruan');
const description = document.getElementById('deskripsi-kejuruan');
const btnSimpan = document.getElementById('btn-simpan');
const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validDescription = description.nextElementSibling;
const invalidDescription = validDescription.nextElementSibling;
const regexName = /^[a-zA-Z ]+$/;
const regexDesc = /^[a-zA-Z0-9 .,]+$/;
let instituteId = null;

axios.get('/institute/getInstituteId')
    .then(response => {
        if (response.data.success && !response.data.isEmpty) {
            instituteId = response.data.institutes.id;
        } else {
            errorAlert(response.data.message);
        }
    })
    .catch(error => {
        errorAlert(error.message);
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
        questionAlert("Simpan data?", "Pastikan semua data telah diisi dengan benar!", "Ya, Simpan", () => {
            axios.post(`/department/addDepartment`, {
                'name': name.value,
                'description': description.value,
                'instituteID': instituteId,
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert("Data berhasil disimpan!", response.data.redirect_url);
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