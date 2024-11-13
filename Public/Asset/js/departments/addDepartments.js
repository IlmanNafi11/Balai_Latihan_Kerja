import {errorAlert, questionAlert, successAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate, validateFile} from "../helper/validators.js";

const name = document.getElementById('nama-kejuruan');
const description = document.getElementById('deskripsi-kejuruan');
const btnSimpan = document.getElementById('btn-simpan');
const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validDescription = description.nextElementSibling;
const invalidDescription = validDescription.nextElementSibling;
const inputFoto = document.getElementById('fileInput');
const uploadArea = document.getElementById('upload-area');
const uploadIcon = document.getElementById('uploadIcon');
const uploadText = document.getElementById('uploadText');
const formatText = document.getElementById('formatText');
const validFoto = uploadArea.nextElementSibling;
const invalidFoto = validFoto.nextElementSibling;
const allowedTypes = ['image/jpeg', 'image/png'];
const maxFileSize = 2 * 1024 * 1024;
const regexName = /^[a-zA-Z ]+$/;
const regexDesc = /^[a-zA-Z0-9 .,]+$/;
let instituteId = null;
let file = null;

uploadArea.addEventListener('click', function () {
    inputFoto.click();
});

inputFoto.addEventListener('change', () => {
    file = inputFoto.files[0];
    if (validateFile(file, "Foto", validFoto, invalidFoto, allowedTypes, maxFileSize, uploadArea)) {
        const reader = new FileReader();
        reader.onload = function (e) {
            uploadIcon.src = e.target.result;
            uploadIcon.style.display = 'block';;
            uploadText.style.display = 'none';
            formatText.style.display = 'none';
        };
        reader.readAsDataURL(file);

    } else {
        inputFoto.value = "";
        uploadIcon.src = "/Asset/images/upload_icons.png"
        uploadText.style.display = 'block';
        formatText.style.display = 'block';
    }
});
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
    isValid = validateFile(file, "Foto", validFoto, invalidFoto, allowedTypes, maxFileSize, uploadArea) && isValid;
    if (isValid) {
        questionAlert("Simpan data?", "Pastikan semua data telah diisi dengan benar!", "Ya, Simpan", () => {
            const formData = new FormData();
            formData.append('name', name.value.trim());
            formData.append('description', description.value.trim());
            formData.append('instituteId', instituteId);
            formData.append('image', file);
            axios.post(`/department/addDepartment`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
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