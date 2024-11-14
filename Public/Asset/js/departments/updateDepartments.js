import {successAlert, errorAlert, questionAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate, sliceUri, validateFile} from "../helper/validators.js";

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
let id = sliceUri();
let file = null;
let imageUrl = null;

axios.get(`/department/${id}/data`)
    .then(response => {
        if (response.data.success && !response.data.isEmpty) {
            name.value = response.data.department.nama;
            description.value = response.data.department.deskripsi;
            if (response.data.department.image_path) {
                imageUrl = "/" + response.data.department.image_path;
                uploadIcon.src = imageUrl;
                uploadText.style.display = 'none';
            }
        } else {
            errorAlert(response.data.message);
        }
    })
    .catch(error => {
        errorAlert(error.response);
    });

uploadArea.addEventListener('click', function () {
    inputFoto.click();
});

inputFoto.addEventListener('change', () => {
    file = inputFoto.files[0];
    if (validateFile(file, "Foto", validFoto, invalidFoto, allowedTypes, maxFileSize, uploadArea)) {
        const reader = new FileReader();
        reader.onload = function (e) {
            uploadIcon.src = e.target.result;
            uploadIcon.style.display = 'block';
            uploadText.style.display = 'none';
            formatText.style.display = 'none';
        };
        reader.readAsDataURL(file);

    } else {
        inputFoto.value = "";
        uploadIcon.src = imageUrl;
        formatText.style.display = 'block';
    }
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
            const formData = new FormData();
            formData.append('name', name.value.trim());
            formData.append('description', description.value.trim());
            if (file) {
                formData.append('image', file);
            }
            axios.post(`/department/update/${id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert(response.data.message, response.data.redirect);
                    } else {
                        errorAlert(response.data.message);
                    }
                })
                .catch(error => {
                    errorAlert(error.message);
                });
        });
    }
});