import {sliceUri, blurValidate, onSaveValidate, validateFile} from "../helper/validators.js";
import {successAlert, errorAlert, questionAlert} from "../helper/exceptions.js";

const name = document.getElementById('nama-instruktor');
const email = document.getElementById('email-instruktor');
const address = document.getElementById('alamat-instruktor');
const phone = document.getElementById('no-hp-instruktor');
const inputFoto = document.getElementById('fileInput');
const uploadArea = document.getElementById('upload-area');
const uploadIcon = document.getElementById('uploadIcon');
const uploadText = document.getElementById('uploadText');
const formatText = document.getElementById('formatText');
const validFoto = uploadArea.nextElementSibling;
const invalidFoto = validFoto.nextElementSibling;
const allowedTypes = ['image/jpeg', 'image/png'];
const maxFileSize = 2 * 1024 * 1024;
const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validEmail = email.nextElementSibling;
const invalidEmail = validEmail.nextElementSibling;
const validPhone = phone.nextElementSibling;
const invalidPhone = validPhone.nextElementSibling;
const validAddress = address.nextElementSibling;
const invalidAddress = validAddress.nextElementSibling;

const regexNama = /^[a-zA-Z ,.']+$/;
const regexNoTlp = /^08[0-9]+$/;
const regexEmail = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;
const regexKombinasi = /^[a-zA-Z0-9 ,.]+$/;
let file = null;
let id = sliceUri();
let imageUrl = null;
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
        uploadIcon.src = "/Asset/images/upload_icons.png"
        uploadText.style.display = 'block';
        formatText.style.display = 'block';
    }
});

const btnPerbarui = document.getElementById('btn-perbarui');

axios.get(`/instructor/${id}/data`)
    .then(response => {
        if (response.data.success && !response.data.isEmpty) {
            name.value = response.data.instructor.nama;
            email.value = response.data.instructor.email;
            address.value = response.data.instructor.alamat;
            phone.value = response.data.instructor.no_tlp;
            if (response.data.instructor.image_path) {
                imageUrl = "/" + response.data.instructor.image_path;
                uploadIcon.src = imageUrl;
                uploadText.style.display = 'none';
            }
        } else {
            errorAlert(response.data.message);
        }
    })
    .catch(error => {
        errorAlert(error.message);
    })

blurValidate(name, "Nama Instruktor", validName, invalidName, null, regexNama, 50);
blurValidate(email, "Email Instruktor", validEmail, invalidEmail, null, regexEmail, 50);
blurValidate(phone, "Nomor Hp Instruktor", validPhone, invalidPhone, null, regexNoTlp, 13);
blurValidate(address, "Alamat Instruktor", validAddress, invalidAddress, null, regexKombinasi, 150);

btnPerbarui.addEventListener('click', (e) => {
    e.preventDefault();
    let isValid = true;

    isValid = onSaveValidate(name, "Nama Instruktor", validName, invalidName, null, regexNama, 50) && isValid;
    isValid = onSaveValidate(email, "Email Instruktor", validEmail, invalidEmail, null, regexEmail, 50) && isValid;
    isValid = onSaveValidate(phone, "Nomor Hp Instruktor", validPhone, invalidPhone, null, regexNoTlp, 13) && isValid;
    isValid = onSaveValidate(address, "Alamat Instruktor", validAddress, invalidAddress, null, regexKombinasi, 150) && isValid;

    if (isValid) {
        questionAlert("Simpan Data?", "Pastikan semua data telah diisi dengan benar", "Ya, Simpan", () => {
            const formData = new FormData();
            formData.append('name', name.value.trim());
            formData.append('email', email.value.trim());
            formData.append('phone', phone.value.trim());
            formData.append('address', address.value.trim());
            if (file) {
                formData.append('image', file);
            }
            axios.post(`/instructor/update/${id}`, formData, {
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