import {errorAlert, successAlert, questionAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate, validateFile} from "../helper/validators.js";
import {
    createDinamicInputText,
    createOptions,
    setMinOnToday
} from "../helper/helperFunction.js";

const containerList = document.getElementById("container-persyaratan-list");
const btnTambah = document.getElementById("btn-tambah-persyaratan");
const btnSimpan = document.getElementById('btn-simpan');
const namaProgram = document.getElementById('nama-program');
const namaKejuruan = document.getElementById('nama-kejuruan');
const namaInstruktor = document.getElementById('nama-instruktor');
const statusPendaftaran = document.getElementById('status-pendaftaran');
const namaGedung = document.getElementById('nama-gedung');
const jmlPeserta = document.getElementById('jml-peserta');
const tglMulaiPendfataran = document.getElementById('tanggal-mulai');
const tglAkhirPendfataran = document.getElementById('tanggal-akhir');
const standarProgram = document.getElementById('standar-program');
const deskripsi = document.getElementById('deskripsi-program');
const namaAlat = document.getElementById('multiple-select-field');
const validName = namaProgram.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validKejuruan = namaKejuruan.nextElementSibling;
const invalidKejuruan = validKejuruan.nextElementSibling;
const validInstructor = namaInstruktor.nextElementSibling;
const invalidInstructor = validInstructor.nextElementSibling;
const validGedung = namaGedung.nextElementSibling;
const invalidGedung = validGedung.nextElementSibling;
const validStatus = statusPendaftaran.nextElementSibling;
const invalidStatus = validStatus.nextElementSibling;
const validJml = jmlPeserta.nextElementSibling;
const invalidJml = validJml.nextElementSibling;
const validStandart = standarProgram.nextElementSibling;
const invalidStandart = validStandart.nextElementSibling;
const validDeskripsi = deskripsi.nextElementSibling;
const invalidDeskripsi = validDeskripsi.nextElementSibling;
const isEmptySyarat = btnTambah.nextElementSibling;
const validAlat = document.getElementById('valid-alat');
const invalidAlat = document.getElementById('invalid-alat');
const inputFoto = document.getElementById('fileInput');
const uploadArea = document.getElementById('upload-area');
const uploadIcon = document.getElementById('uploadIcon');
const uploadText = document.getElementById('uploadText');
const formatText = document.getElementById('formatText');
const validFoto = uploadArea.nextElementSibling;
const invalidFoto = validFoto.nextElementSibling;
const allowedTypes = ['image/jpeg', 'image/png'];
const maxFileSize = 2 * 1024 * 1024;
const regexString = /^[a-zA-Z ]+$/;
const regexComb = /^[a-zA-Z0-9 .,]+$/;
const regexNum = /^[0-9]+$/;
let file = null;
let alat = [];

dataOptions();
setDate();
createDinamicInputText(containerList, btnTambah, "persyaratan-program", isEmptySyarat);

$('#multiple-select-field').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
    closeOnSelect: true,
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
            ;
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

blurValidate(namaProgram, "Nama Program", validName, invalidName, null, regexString, 50);
blurValidate(namaKejuruan, "Nama Kejuruan", validKejuruan, invalidKejuruan, "default", null, 50);
blurValidate(namaInstruktor, "Nama Instruktor", validInstructor, invalidInstructor, "default", null, 50);
blurValidate(statusPendaftaran, "Status Pendaftaran", validStatus, invalidStatus, "status", null, 10);
blurValidate(namaGedung, "Nama Gedung", validGedung, invalidGedung, "default", null, 50);
blurValidate(jmlPeserta, "Jumlah Peserta", validJml, invalidJml, null, regexNum, 5);
blurValidate(standarProgram, "Standar program", validStandart, invalidStandart, null, regexString, 6);
blurValidate(deskripsi, "Deskripsi Program", validDeskripsi, invalidDeskripsi, null, regexComb, 255);

function validateAlat() {
    let isSelected = $('#multiple-select-field').val().length !== 0;
    namaAlat.classList.remove('is-valid', 'is-invalid');
    if (!isSelected) {
        namaAlat.classList.add('is-invalid');
        invalidAlat.textContent = 'Pilih alat yang tersedia!';
        return false;
    }
    validAlat.textContent = "Alat alat program dipilih dengan baik";
    namaAlat.classList.add('is-valid');
    return true;
}

function validateInputPersyaratan() {
    const inputs = document.querySelectorAll('input[name="persyaratan-program"]');
    let hasValue = false;
    let allFilled = true;
    let validPersyaratan;
    let invalidPersyaratan;

    if (inputs && inputs.length === 0) {
        btnTambah.classList.add('is-invalid');
        isEmptySyarat.textContent = 'Tambahkan setidaknya 1 persyaratan';
        isEmptySyarat.style.display = "block";
        isEmptySyarat.style.color = "#dc3545"
        return false;
    }

    inputs.forEach(input => {
        validPersyaratan = input.nextElementSibling;
        invalidPersyaratan = validPersyaratan.nextElementSibling;
        blurValidate(input, "Persyaratan Program", validPersyaratan, invalidPersyaratan, null, /^[a-zA-Z0-9 .,]+$/, 100);
        let isValidPersyaratan = onSaveValidate(input, "Persyaratan Program", validPersyaratan, invalidPersyaratan, null, /^[a-zA-Z0-9 .,]+$/, 100);
        if (!isValidPersyaratan) {
            allFilled = false;
        } else {
            hasValue = true;
        }
    });

    if (!allFilled) {
        invalidPersyaratan.textContent = "Input Persyaratan harus di isi, atau hapus jika tidak perlu";
        return false;
    }
    return hasValue;
}

btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();
    file = inputFoto.files[0];
    alat = $('#multiple-select-field').val();

    let isValid = true;
    isValid = validateAlat() && isValid;
    isValid = validateInputPersyaratan() && isValid;
    isValid = validateFile(file, "Foto", validFoto, invalidFoto, allowedTypes, maxFileSize, uploadArea) && isValid;
    isValid = onSaveValidate(namaProgram, "Nama Program", validName, invalidName, null, regexString, 50) && isValid;
    isValid = onSaveValidate(namaKejuruan, "Nama Kejuruan", validKejuruan, invalidKejuruan, "default", null, 50) && isValid;
    isValid = onSaveValidate(namaInstruktor, "Nama Instruktor", validInstructor, invalidInstructor, "default", null, 50) && isValid;
    isValid = onSaveValidate(statusPendaftaran, "Status Pendaftaran", validStatus, invalidStatus, "status", null, 10) && isValid;
    isValid = onSaveValidate(namaGedung, "Nama Gedung", validGedung, invalidGedung, "default", null, 50) && isValid;
    isValid = onSaveValidate(jmlPeserta, "Jumlah Peserta", validJml, invalidJml, null, regexNum, 5) && isValid;
    isValid = onSaveValidate(standarProgram, "Bagus!", validStandart, invalidStandart, null, regexString, 6) && isValid;
    isValid = onSaveValidate(deskripsi, "Bagus!", validDeskripsi, invalidDeskripsi, null, regexComb, 255) && isValid;
    if (isValid) {

        questionAlert('Simpan Data?', 'Pastikan semua data telah diisi dengan benar!', "Ya, Simpan", () => {
            const formData = new FormData();
            formData.append('name', namaProgram.value);
            formData.append('status_register', statusPendaftaran.value);
            formData.append('start_date', tglMulaiPendfataran.value);
            formData.append('end_date', tglAkhirPendfataran.value);
            formData.append('standar', standarProgram.value);
            formData.append('participant', jmlPeserta.value);
            formData.append('description', deskripsi.value);
            formData.append('instructor_id', namaInstruktor.value);
            formData.append('building_id', namaGedung.value);
            formData.append('department_id', namaKejuruan.value);
            formData.append('image', file);
            const inputs = document.querySelectorAll('input[name="persyaratan-program"]');
            inputs.forEach((item, index) => {
                formData.append('requirements[' + index + ']', item.value);
            })
            alat.forEach((item, index) => {
                formData.append('tools[' + index + ']', item);
            })
            axios.post('/programs/add', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert(response.data.message, response.data.redirect);
                    }
                })
                .catch(error => {
                    errorAlert(error.message);
                })
        });
    }

});

/**
 * Mengatur nilai {tglMulaiPendfataran} ke tanggal hari ini sebagai nilai default,
 * menambahkan contraint untuk batas {tglAkhirPendfataran} yang dapat dipilih agar tidak kurang dari nilai {tglMulaiPendfataran}
 * @see setMinOnToday
 */
function setDate() {
    setMinOnToday(tglMulaiPendfataran);
    setMinOnToday(tglAkhirPendfataran);
    tglMulaiPendfataran.addEventListener("change", function () {
        let startDate = tglMulaiPendfataran.value;
        tglAkhirPendfataran.setAttribute("min", startDate);
        if (tglAkhirPendfataran.value < startDate) {
            tglAkhirPendfataran.value = startDate;
        }
    });
}

/**
 * Mengambil data option untuk diisi ke element select terkait
 * @see createOptions
 */
function dataOptions() {

    axios.get(`/department/department-name`)
        .then(response => {
            if (response.data.success) {
                createOptions(response.data.departments, namaKejuruan, false, "Pilih Kejuruan");
            } else {
                errorAlert(response.data.message);
            }
        })
        .catch(error => {
            errorAlert(error.data.message);
        });

    axios.get(`/instructor/instructor-name`)
        .then(response => {
            if (response.data.success) {
                createOptions(response.data.instructors, namaInstruktor, false, "Pilih Instruktor");
            } else {
                errorAlert(response.data.message);
            }
        })
        .catch(error => {
            errorAlert(error.data.message);
        })

    axios.get(`/building/building-name`)
        .then(response => {
            if (response.data.success) {
                createOptions(response.data.buildings, namaGedung, false, "Pilih Gedung");
            } else {
                errorAlert(response.data.message);
            }
        })
        .catch(error => {
            errorAlert(error.data.message);
        })

    axios.get(`/tools/tools-name`)
        .then(response => {
            if (response.data.success) {
                createOptions(response.data.tools, namaAlat, false);
            } else {
                errorAlert(response.data.message);
            }
        })
        .catch(error => {
            errorAlert(error.data.message);
        })
}







