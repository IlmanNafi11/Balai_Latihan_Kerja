import {successAlert, errorAlert, questionAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate} from "../helper/validators.js";

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
const regexEmail = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;

blurValidate(name, "Input Nama Admin", validName, invalidName, null, regexNama, 50);
blurValidate(phone, "Input Nomor Telephon", validPhone, invalidPhone, null, regexNoTlp, 13);
blurValidate(email, "Input Email", validEmail, invalidEmail, null, regexEmail, 70);
blurValidate(password, "Input Password", validPassword, invalidPassword, null, regexPassword, 15);
blurValidate(ttl, "Input Tanggal Lahir", validTtl, invalidTtl, null, null, 12);
blurValidate(jenisKelamin, "Input Jenis Kelamin", validJenisKelamin, invalidJenisKelamin, 'default', null, 10);
blurValidate(alamat, "Input Alamat", validAlamat, invalidAlamat, null, regexAlamat, 100);
let validFoto = false;

uploadArea.addEventListener('click', function () {
    pasFoto.click();
});

pasFoto.addEventListener('change', () => {
    const file = pasFoto.files[0];
    const allowedTypes = ['image/jpeg', 'image/png'];
    const maxFileSize = 2 * 1024 * 1024;
    uploadArea.classList.remove('is-valid', 'is-invalid')
    if (file && allowedTypes.includes(file.type) && file.size <= maxFileSize) {
        uploadArea.classList.add('is-valid');
        validPasFoto.textContent = "Pas Foto valid";
        validFoto = true;
    } else {
        pasFoto.value = "";
        uploadArea.classList.add('is-invalid');
        invalidPasFoto.textContent = "Pas foto tidak valid atau terlalu besar (maksimal 2MB)";
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        // Buat elemen gambar baru untuk pratinjau
        let previewImg = document.getElementById('previewImg');
        if (!previewImg) {
            previewImg = document.createElement('img');
            previewImg.id = 'previewImg';
            previewImg.classList.add('preview-img');
            uploadArea.appendChild(previewImg);
        }

        previewImg.src = e.target.result;
        previewImg.style.display = 'block';
        uploadIcon.style.display = 'none';
        uploadText.style.display = 'none';
        formatText.style.display = 'none';
    };
    reader.readAsDataURL(file);
});

document.getElementById('btn-simpan').addEventListener('click', (e) => {
    e.preventDefault();
    let isValid = true;
    isValid = onSaveValidate(name, "Input Nama Admin", validName, invalidName, null, regexNama, 50) && isValid;
    isValid = onSaveValidate(phone, "Input Nomor Telephon", validPhone, invalidPhone, null, regexNoTlp, 13) && isValid;
    isValid = onSaveValidate(email, "Input Email", validEmail, invalidEmail, null, regexEmail, 70) && isValid;
    isValid = onSaveValidate(password, "Input Password", validPassword, invalidPassword, null, regexPassword, 15) && isValid;
    isValid = onSaveValidate(ttl, "Input Tanggal Lahir", validTtl, invalidTtl, null, null, 12) && isValid;
    isValid = onSaveValidate(jenisKelamin, "Input Jenis Kelamin", validJenisKelamin, invalidJenisKelamin, 'default', null, 10) && isValid;
    isValid = onSaveValidate(alamat, "Input Alamat", validAlamat, invalidAlamat, null, regexAlamat, 100) && isValid;

    const file = pasFoto.files[0];

    if (validFoto && isValid && file) {
        questionAlert("Simpan Data?", "Pastikan semua data telah diisi dengan benar", "Ya, Simpan", () => {

            const formData = new FormData();
            formData.append('name', name.value.trim());
            formData.append('email', email.value.trim());
            formData.append('password', password.value.trim());
            formData.append('phone', phone.value.trim());
            formData.append('tanggal_lahir', ttl.value.trim());
            formData.append('jenis_kelamin', jenisKelamin.value.trim());
            formData.append('alamat', alamat.value.trim());
            formData.append('pas_foto', file);

            axios.post('/user/create', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert("Data berhasil disimpan!", response.data.redirect_url);
                    } else {
                        errorAlert(response.data.message);
                    }
                })
                .catch(error => {
                    errorAlert(error.response);
                })
        });
    } else {
        errorAlert('Pastikan form dan pas foto diisi dengan benar')
    }
});
