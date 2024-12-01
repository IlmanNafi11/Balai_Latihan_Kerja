import {successAlert, errorAlert, questionAlert, warningAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate, validateFile} from "../helper/validators.js";

const name = document.getElementById('nama-admin');
const phone = document.getElementById('no-hp-admin');
const email = document.getElementById('email-admin');
const password = document.getElementById('kata-sandi-admin');
const ttl = document.getElementById('tanggal-lahir-admin');
const jenisKelamin = document.getElementById('jenis-kelamin');
const alamat = document.getElementById('alamat-admin');
const pasFoto = document.getElementById('fileInput');
const uploadArea = document.getElementById('upload-area');
const uploadIcon = document.getElementById('uploadIcon');
const uploadText = document.getElementById('uploadText');
const formatText = document.getElementById('formatText');

const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validPhone = phone.nextElementSibling;
const invalidPhone = validPhone.nextElementSibling;
const validEmail = email.nextElementSibling;
const invalidEmail = validEmail.nextElementSibling;
const validPassword = password.nextElementSibling;
const invalidPassword = validPassword.nextElementSibling;
const validTtl = ttl.nextElementSibling;
const invalidTtl = validTtl.nextElementSibling;
const validJenisKelamin = jenisKelamin.nextElementSibling;
const invalidJenisKelamin = validJenisKelamin.nextElementSibling;
const validAlamat = alamat.nextElementSibling;
const invalidAlamat = validAlamat.nextElementSibling;
const validPasFoto = uploadArea.nextElementSibling;
const invalidPasFoto = validPasFoto.nextElementSibling;

const regexNama = /^[a-zA-Z ,.']+$/;
const regexPassword = /^[a-zA-Z0-9]+$/;
const regexAlamat = /^[a-zA-Z0-9 ,.]+$/;
const regexNoTlp = /^08[0-9]+$/;
const regexEmail = /^[a-zA-Z0-9._]+@gmail\.com$/;
const allowedTypes = ['image/jpeg', 'image/png'];
const maxFileSize = 2 * 1024 * 1024;

blurValidate(name, "Input Nama Admin", validName, invalidName, null, regexNama, 50);
blurValidate(phone, "Input Nomor Telephon", validPhone, invalidPhone, null, regexNoTlp, 13);
blurValidate(email, "Input Email", validEmail, invalidEmail, null, regexEmail, 70);
blurValidate(password, "Input Password", validPassword, invalidPassword, null, regexPassword, 15);
blurValidate(ttl, "Input Tanggal Lahir", validTtl, invalidTtl, null, null, 12);
blurValidate(jenisKelamin, "Input Jenis Kelamin", validJenisKelamin, invalidJenisKelamin, 'default', null, 10);
blurValidate(alamat, "Input Alamat", validAlamat, invalidAlamat, null, regexAlamat, 100);
let validFoto = false;

const today = new Date().toISOString().split('T')[0];
ttl.max = today;

uploadArea.addEventListener('click', function () {
    pasFoto.click();
});

pasFoto.addEventListener('change', () => {
    const file = pasFoto.files[0];
    if (validateFile(file, "Pas Foto", validPasFoto, invalidPasFoto, allowedTypes, maxFileSize, uploadArea)) {
        const reader = new FileReader();
        reader.onload = function (e) {
            uploadIcon.src = e.target.result;
            uploadIcon.style.display = 'block';
            uploadText.style.display = 'none';
            formatText.style.display = 'none';
            validFoto = true;
        };
        reader.readAsDataURL(file);

    } else {
        pasFoto.value = "";
        uploadIcon.src = "/Asset/images/upload_icons.png"
        uploadText.style.display = 'block';
        formatText.style.display = 'block';
        validFoto = false;
    }
});

document.getElementById('btn-simpan').addEventListener('click', (e) => {
    e.preventDefault();
    let isValid = true;
    const file = pasFoto.files[0];
    isValid = onSaveValidate(name, "Input Nama Admin", validName, invalidName, null, regexNama, 50) && isValid;
    isValid = onSaveValidate(phone, "Input Nomor Telephon", validPhone, invalidPhone, null, regexNoTlp, 13) && isValid;
    isValid = onSaveValidate(email, "Input Email", validEmail, invalidEmail, null, regexEmail, 70) && isValid;
    isValid = onSaveValidate(password, "Input Password", validPassword, invalidPassword, null, regexPassword, 15) && isValid;
    isValid = onSaveValidate(ttl, "Input Tanggal Lahir", validTtl, invalidTtl, null, null, 12) && isValid;
    isValid = onSaveValidate(jenisKelamin, "Input Jenis Kelamin", validJenisKelamin, invalidJenisKelamin, 'default', null, 10) && isValid;
    isValid = onSaveValidate(alamat, "Input Alamat", validAlamat, invalidAlamat, null, regexAlamat, 100) && isValid;
    isValid = validateFile(file, "Pas Foto", validPasFoto, invalidPasFoto, allowedTypes, maxFileSize, uploadArea) && isValid;

    if (isValid) {
        questionAlert("Simpan Data?", "Pastikan semua data telah diisi dengan benar", "Ya, Simpan", () => {
            const file = pasFoto.files[0];
            const formData = new FormData();
            formData.append('name', name.value.trim());
            formData.append('email', email.value.trim());
            formData.append('password', password.value.trim());
            formData.append('phone', phone.value.trim());
            formData.append('tanggal_lahir', ttl.value.trim());
            formData.append('jenis_kelamin', jenisKelamin.value.trim());
            formData.append('alamat', alamat.value.trim());
            formData.append('pas_foto', file);

            axios.post('/user/admin/add', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert(response.data.message, response.data.redirect);
                    } else if (!response.data.isEmpty) {
                        warningAlert(response.data.message);
                        email.classList.remove('is-valid');
                        email.classList.add('is-invalid');
                        invalidEmail.textContent = "Silahkan gunakan email yang lain!";
                    }
                })
                .catch(error => {
                    errorAlert(error.response);
                })
        });
    }
});
