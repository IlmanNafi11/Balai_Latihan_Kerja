import {errorAlert, successAlert, questionAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate, sliceUri, validateFile} from "../helper/validators.js";
import {createOptions, setMinOnToday} from "../helper/helperFunction.js";

const containerList = document.getElementById("container-persyaratan-list");
const btnTambah = document.getElementById("btn-tambah-persyaratan");
const btnSimpan = document.getElementById('btn-perbarui');

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
const id = sliceUri();
let deleteRequirements = [];
let imageUrl = null;
let initialTools = [];
let currentTools = [];

const regexString = /^[a-zA-Z ]+$/;
const regexComb = /^[a-zA-Z0-9 .,]+$/;
const regexNum = /^[0-9]+$/;
let file = null;

$('#multiple-select-field').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
    closeOnSelect: true,
});


getDataOptions();
configDate();

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
blurValidate(standarProgram, "Bagus!", validStandart, invalidStandart, null, regexString, 6);
blurValidate(deskripsi, "Bagus!", validDeskripsi, invalidDeskripsi, null, regexComb, 255);

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

function createNewInputRequirements(value, id) {
    // Membuat elemen container-add-action-control baru
    const newContainer = document.createElement("div");
    newContainer.classList.add("container-add-action-control", "d-flex", "flex-column", "row-gap-1", "mb-3");
    let requirement = value ?? "";
    // Membuat elemen baru
    const inputElement = document.createElement("input");
    inputElement.type = "text";
    inputElement.value = requirement;
    inputElement.name = "persyaratan-program";
    inputElement.classList.add("form-control");
    inputElement.placeholder = "Contoh: Minimum Lulusan SMA";

    if (id) {
        inputElement.setAttribute('data-id', id);
    }

    const containerButton = document.createElement("div");
    containerButton.classList.add("container-button-action-control", "d-flex", "justify-content-end");

    const btnHapusSyarat = document.createElement("button");
    btnHapusSyarat.classList.add("btn", "btn-hapus-persyaratan");
    btnHapusSyarat.type = "button";
    btnHapusSyarat.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                    </svg>`;

    containerButton.appendChild(btnHapusSyarat);

    const containerField = document.createElement("div");
    containerField.classList.add("container-field-persyaratan");
    const validFeedback = document.createElement("div");
    validFeedback.classList.add("valid-feedback");
    const invalidFeedback = document.createElement("div");
    invalidFeedback.classList.add("invalid-feedback");

    containerField.appendChild(inputElement);
    containerField.appendChild(validFeedback);
    containerField.appendChild(invalidFeedback);
    newContainer.appendChild(containerButton);
    newContainer.appendChild(containerField);

    containerList.appendChild(newContainer);

    const btnHapus = newContainer.querySelector(".btn-hapus-persyaratan");

    btnHapus.addEventListener("click", () => {
        deleteRequirements.push(inputElement.getAttribute("data-id"));
        newContainer.remove();
    });
}

btnTambah.addEventListener("click", () => {
    const inputs = document.querySelectorAll('input[name="persyaratan-program"]');
    if (inputs) {
        btnTambah.classList.remove('is-invalid');
        btnTambah.classList.add('is-valid');
        isEmptySyarat.textContent = '';
        isEmptySyarat.style.display = 'none';
    }

    createNewInputRequirements();
});

btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();
    let requirements = [];
    let newRequirements = [];
    currentTools = $('#multiple-select-field').val();
    let isValid = true;
    isValid = validateInputPersyaratan() && isValid;
    isValid = onSaveValidate(namaProgram, "Nama Program", validName, invalidName, null, regexString, 50) && isValid;
    isValid = onSaveValidate(namaKejuruan, "Nama Kejuruan", validKejuruan, invalidKejuruan, "default", null, 50) && isValid;
    isValid = onSaveValidate(namaInstruktor, "Nama Instruktor", validInstructor, invalidInstructor, "default", null, 50) && isValid;
    isValid = onSaveValidate(statusPendaftaran, "Status Pendaftaran", validStatus, invalidStatus, "status", null, 10) && isValid;
    isValid = onSaveValidate(namaGedung, "Nama Gedung", validGedung, invalidGedung, "default", null, 50) && isValid;
    isValid = onSaveValidate(jmlPeserta, "Jumlah Peserta", validJml, invalidJml, null, regexNum, 5) && isValid;
    isValid = onSaveValidate(standarProgram, "Standar Program", validStandart, invalidStandart, null, regexString, 6) && isValid;
    isValid = onSaveValidate(deskripsi, "Deskripsi Program", validDeskripsi, invalidDeskripsi, null, regexComb, 255) && isValid;
    isValid = validateAlat() && isValid;
    if (isValid) {
        questionAlert('Perbarui Data?', 'Pastikan semua data telah diisi dengan benar!', "Ya, Perbarui", () => {
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
            formData.append('initial_tools', JSON.stringify(initialTools));
            formData.append('current_tools', JSON.stringify(currentTools));
            const inputs = document.querySelectorAll('input[name="persyaratan-program"]');
            inputs.forEach((input, index) => {
                let dataId = input.getAttribute("data-id");

                if (dataId) {
                    let data = {
                        "id": dataId,
                        "requirement": input.value
                    };
                    requirements.push(data);
                    formData.append(`requirements[${index}][id]`, data.id);
                    formData.append(`requirements[${index}][requirement]`, data.requirement);
                } else {
                    newRequirements.push(input.value);
                    formData.append(`newRequirements[${index}]`, input.value);
                }
            });
            deleteRequirements.forEach((id, index) => {
                formData.append(`deleteRequirements[${index}]`, id);
            });

            axios.post(`/programs/update/${id}`, formData, {
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
                    errorAlert(error.response.data.message);
                })
        });
    }

});


function configDate() {
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

function getDataOptions() {
    axios.get(`/department/department-name`)
        .then(response => {
            if (response.data.success) {
                createOptions(response.data.departments, namaKejuruan, false, "Pilih Kejuruan");
            }
        })
        .catch(error => {
            console.log(error.message);
        });

    axios.get(`/instructor/instructor-name`)
        .then(response => {
            if (response.data.success) {
                createOptions(response.data.instructors, namaInstruktor, false, "Pilih Instruktor");
            }
        })
        .catch(error => {
            console.log(error.message);
        })

    axios.get(`/building/building-name`)
        .then(response => {
            if (response.data.success) {
                createOptions(response.data.buildings, namaGedung, false, "Pilih Gedung");
            }
        })
        .catch(error => {
            console.log(error.message)
        })

    axios.get(`/tools/tools-name`)
        .then(response => {
            if (response.data.success) {
                createOptions(response.data.tools, namaAlat, false);
            }
        })
        .catch(error => {
            errorAlert(error.data.message);
        })
}

axios.get(`/programs/${id}/data`)
    .then(response => {
        if (response.data.success){
            let programs = response.data.programs;
            let requirements = response.data.requirements;
            let tools = response.data.tools;

            namaProgram.value = programs[0]['nama'];
            namaKejuruan.value = programs[0]['department_id'];
            namaInstruktor.value = programs[0]['instructor_id'];
            statusPendaftaran.value = programs[0]['status_pendaftaran'];
            namaGedung.value = programs[0]['building_id'];
            jmlPeserta.value = programs[0]['jml_peserta'];
            tglMulaiPendfataran.value = programs[0]['tgl_mulai_pendaftaran'];
            tglAkhirPendfataran.value = programs[0]['tgl_akhir_pendaftaran'];
            standarProgram.value = programs[0]['standar'];
            deskripsi.value = programs[0]['deskripsi'];
            requirements.forEach(requirement => {
                createNewInputRequirements(requirement.requirement, requirement.id);
            });

            initialTools = tools.map(tool => tool.tool_id);
            $('#multiple-select-field').val(initialTools).trigger('change');

            if (programs[0]['image_path']) {
                imageUrl = "/" + programs[0]['image_path'];
                uploadIcon.src = imageUrl;
                uploadText.style.display = 'none';
            }
        }
    })
    .catch(error => {
        errorAlert(error.response.data.message);
    })