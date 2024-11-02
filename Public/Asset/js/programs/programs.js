// import {cancelAlert, errorAlert, successAlert, questionAlert} from "../helper/exceptions.js";
// import { emptyValidate, blurValidate } from "../helper/validators.js";
//
// // Element form
// const containerList = document.getElementById("container-persyaratan-list");
// const btnTambah = document.getElementById("btn-tambah-persyaratan");
// const btnSimpan = document.getElementById('btn-simpan');
//
// const namaProgram = document.getElementById('nama-program');
// const namaKejuruan = document.getElementById('nama-kejuruan');
// const namaInstruktor = document.getElementById('nama-instruktor');
// const statusPendaftaran = document.getElementById('status-pendaftaran');
// const namaGedung = document.getElementById('nama-gedung');
// const jmlPeserta = document.getElementById('jml-peserta');
// const tglMulaiPendfataran = document.getElementById('tanggal-mulai');
// const tglAkhirPendfataran = document.getElementById('tanggal-akhir');
// const standarProgram = document.getElementById('standar-program');
// const deskripsi = document.getElementById('deskripsi-program');
// const syaratProgram = document.getElementById('persyaratan-program');
//
//
//
// window.getAddView = getAddView;
// window.getUpdateView = getUpdateView;
//
// function getAddView(endPoint) {
//     axios.get(`${endPoint}`)
//         .then(response => {
//             if (response.status == 200) {
//                 window.location.href = endPoint;
//             }
//         })
//         .catch(error => {
//             console.log(error);
//         })
// }
//
// function getUpdateView(endPoint) {
//     axios.get(`${endPoint}`)
//         .then(response => {
//             if (response.status == 200) {
//                 window.location.href = endPoint;
//             }
//         })
//         .catch(error => {
//             console.log(error);
//         })
// }
//
// function blurValidationEvent(){
//
// }
//
// function validateInput(){
//     // Get element
//     const validName = namaProgram.nextElementSibling;
//     const invalidName = validName.nextElementSibling;
//     const validKejuruan = namaKejuruan.nextElementSibling;
//     const invalidKejuruan = validKejuruan.nextElementSibling;
//     const validInstructor = namaInstruktor.nextElementSibling;
//     const invalidInstructor = validInstructor.nextElementSibling;
//     const validGedung = namaGedung.nextElementSibling;
//     const invalidGedung = validGedung.nextElementSibling;
//     const validStatus = statusPendaftaran.nextElementSibling;
//     const invalidStatus = validStatus.nextElementSibling;
//     const validJml = jmlPeserta.nextElementSibling;
//     const invalidJml = validJml.nextElementSibling;
//     const validStandart = standarProgram.nextElementSibling;
//     const invalidStandart = validStandart.nextElementSibling;
//     const validDeskripsi = deskripsi.nextElementSibling;
//     const invalidDeskripsi = validDeskripsi.nextElementSibling;
//     const isEmptySyarat = btnTambah.nextElementSibling;
//
//     // Blur Event Validator
//     let isValidNama = blurValidate(namaProgram, "Bagus", "Nama Program tidak boleh kosong", validName, invalidName);
//     let isValidKejuruan = blurValidate(namaKejuruan, "Bagus!", "Silahkan pilih Kejuruan dari program terkait!", validKejuruan, invalidKejuruan, "default");
//     let isValidInstruktor = blurValidate(namaInstruktor, "Bagus!", "Silahkan pilih instruktor dari program terkait!", validInstructor, invalidInstructor, "default");
//     let isValidStatus = blurValidate(statusPendaftaran, "Bagus", "Silahkan pilih status pendaftaran!", validStatus, invalidStatus, "status");
//     let isValidGedung = blurValidate(namaGedung, "Bagus", "Silahkan pilih gedung pelatihan program terkait!", validGedung, invalidGedung, "default");
//     let isValidPeserta = blurValidate(jmlPeserta, "Bagus!", "Jumlah peserta tidak boleh kosong!", validJml, invalidJml);
//     let isValidStandar = blurValidate(standarProgram, "Bagus!", "Standar Program tidak boleh kosong!", validStandart, invalidStandart);
//     let isValidDeskripsi = blurValidate(deskripsi, "Bagus!", "Deskripsi Program tidak boleh kosong!", validDeskripsi, invalidDeskripsi);
//
//     // Validasi input kosong dari pengguna
//     isValidNama = isValidNama && emptyValidate(namaProgram, "Bagus!", "Nama Program tidak boleh kosong!", validName, invalidName);
//     isValidKejuruan = isValidKejuruan && emptyValidate(namaKejuruan, "Bagus!", "Silahkan pilih Kejuruan dari program terkait!", validKejuruan, invalidKejuruan, "default");
//     isValidInstruktor = isValidInstruktor && emptyValidate(namaInstruktor, "Bagus!", "Silahkan pilih instruktor dari program terkait!", validInstructor, invalidInstructor, "default");
//     isValidStatus = isValidStatus && emptyValidate(statusPendaftaran, "Bagus", "Silahkan pilih status pendaftaran!", validStatus, invalidStatus, "status");
//     isValidGedung = isValidGedung && emptyValidate(namaGedung, "Bagus", "Silahkan pilih gedung pelatihan program terkait!", validGedung, invalidGedung, "default");
//     isValidPeserta = isValidPeserta && emptyValidate(jmlPeserta, "Bagus!", "Jumlah peserta tidak boleh kosong!", validJml, invalidJml);
//     isValidStandar = isValidStandar && emptyValidate(standarProgram, "Bagus!", "Standar Program tidak boleh kosong!", validStandart, invalidStandart);
//     isValidDeskripsi = isValidDeskripsi && emptyValidate(deskripsi, "Bagus!", "Deskripsi Program tidak boleh kosong!", validDeskripsi, invalidDeskripsi);
//
//     // Validasi input kosong persyaratan programs
//     const inputs = document.querySelectorAll('input[name="persyaratan-program"]');
//     let hasValue = false;
//     let allFilled = true;
//     const values = [];
//
//     inputs.forEach(input => {
//         const validPersyaratan = input.nextElementSibling;
//         const invalidPersyaratan = validPersyaratan.nextElementSibling;
//         const isValidPersyaratan = emptyValidate(input, "Bagus!", "Persyaratan tidak boleh kosong!", validPersyaratan, invalidPersyaratan);
//         if (!isValidPersyaratan) {
//             allFilled = false;
//         } else {
//             btnTambah.classList.remove('is-invalid');
//             hasValue = true;
//             values.push(input.value.trim());
//         }
//     });
//
//     if (!hasValue) {
//         btnTambah.classList.add('is-invalid');
//         isEmptySyarat.textContent = "Silakan tambahkan setidaknya satu persyaratan yang terisi.";
//         isEmptySyarat.style.display = "block";
//         isEmptySyarat.style.color = "#dc3545";
//     } else if (!allFilled) {
//         // alert("Semua input persyaratan harus terisi. Silakan periksa kembali.");
//     } else {
//         // Lakukan sesuatu dengan nilai yang diambil, seperti mengirim ke server atau lainnya
//         console.log("Nilai persyaratan yang terisi:", values);
//         alert("Data berhasil disimpan: " + values.join(", "));
//     }
// }
//
// // Fungsi untuk create programs
// function createPrograms() {
//     validateInput();
// }
// if (document.getElementById('form-add-programs')) {
//     getDataOptions();
//     validateInput();
//     configDate();
//     btnTambah.addEventListener("click", tambahPersyaratan);
//
//     // Event Listerner Button Simpan
//     btnSimpan.addEventListener('click', (e) => {
//         e.preventDefault();
//         createPrograms();
//
//     })
// } else if (document.getElementById("form-update-programs")){
//
// }
//
// function configDate() {
//     const today = new Date().toLocaleDateString('en-CA');
//     tglMulaiPendfataran.setAttribute("min", today);
//     tglMulaiPendfataran.value = today;
//     tglAkhirPendfataran.setAttribute("min", today);
//     tglAkhirPendfataran.value = today;
//     tglMulaiPendfataran.addEventListener("change", function () {
//         let startDate = tglMulaiPendfataran.value;
//         tglAkhirPendfataran.setAttribute("min", startDate);
//         if (tglAkhirPendfataran.value < startDate) {
//             tglAkhirPendfataran.value = startDate;
//         }
//     });
// }
//
// function getDataOptions() {
//     axios.get(`/department/getDepartmentName`)
//         .then(response => {
//             if (response.data.success) {
//                 createOptions(response.data.departments, namaKejuruan, false, "Pilih Kejuruan");
//             } else {
//                 errorAlert(response.data.message);
//             }
//         })
//         .catch(error => {
//             console.log(error.message);
//         });
//
//     axios.get(`/instructor/getInstructorName`)
//         .then(response => {
//             if (response.data.success) {
//                 createOptions(response.data.instructors, namaInstruktor, false, "Pilih Instruktor");
//             } else {
//                 errorAlert(response.data.message);
//             }
//         })
//         .catch(error => {
//             console.log(error.message);
//         })
//
//     axios.get(`/building/getBuildingName`)
//         .then(response => {
//             if (response.data.success) {
//                 createOptions(response.data.buildings, namaGedung, false, "Pilih Gedung");
//             } else {
//                 errorAlert(response.data.message);
//             }
//         })
//         .catch(error => {
//             // Handler 404
//             console.log(error.message)
//         })
// }
//
// function createOptions(data, element, selectedID, defaultContent) {
//     element.innerHTML = '';
//     const defOption = document.createElement('option');
//     defOption.value = "default";
//     defOption.textContent = defaultContent;
//     defOption.disabled = true;
//     defOption.selected = true;
//     element.appendChild(defOption);
//     data.forEach(item => {
//         const option = document.createElement('option');
//         option.value = item.id;
//         option.textContent = item.nama;
//         element.appendChild(option);
//     });
//     if (selectedID) {
//         element.selected = selectedID;
//     }
// }
//
// function tambahPersyaratan() {
//     // Membuat elemen container-add-action-control baru
//     const newContainer = document.createElement("div");
//     newContainer.classList.add("container-add-action-control", "d-flex", "flex-column", "row-gap-1", "mb-3");
//
//     // Menambahkan untuk elemen baru
//     newContainer.innerHTML = `
//             <div class="container-button-action-control d-flex justify-content-end">
//                 <button type="button" class="btn btn-hapus-persyaratan">
//                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
//                         <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
//                     </svg>
//                 </button>
//             </div>
//             <div class="container-field-persyaratan">
//                 <input type="text" name="persyaratan-program" class="form-control" id="persyaratan-program" placeholder="Contoh: Minimum Lulusan SMA">
//                 <div class="valid-feedback" id="valid-feedback-email"></div>
//                 <div class="invalid-feedback" id="invalid-feedback-email"></div>
//             </div>
//         `;
//
//     // Menambahkan elemen baru ke dalam containernya
//     containerList.appendChild(newContainer);
//
//     // Event listener untuk tombol hapus pada elemen baru
//     const btnHapus = newContainer.querySelector(".btn-hapus-persyaratan");
//     btnHapus.addEventListener("click", () => {
//         newContainer.remove();
//     });
// }
//
