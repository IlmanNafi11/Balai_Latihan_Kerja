import {sliceUri, onSaveValidate, blurValidate} from "../helper/validators.js";
import {errorAlert, questionAlert, successAlert} from "../helper/exceptions.js";

const nama = document.getElementById('nama-institusi');
const pimpinan = document.getElementById('nama-pimpinan');
const noVin = document.getElementById('nomor-vin');
const noSotk = document.getElementById('nomor-sotk');
const tahunBerdiri = document.getElementById('tahun-berdiri');
const tipeInstitusi = document.getElementById('tipe-institusi');
const kepemilikan = document.getElementById('kepemilikan-institusi');
const statusBeroperasi = document.getElementById('status-beroperasi');
const noTlp = document.getElementById('telepon-institusi');
const noFax = document.getElementById('nomor-fax');
const email = document.getElementById('email-institusi');
const website = document.getElementById('link-website');
const deskripsi = document.getElementById('deskripsi-institusi');

const validNama = nama.nextElementSibling;
const invalidNama = validNama.nextElementSibling;
const validPimpinan = pimpinan.nextElementSibling;
const invalidPimpinan = validPimpinan.nextElementSibling;
const validNoVin = noVin.nextElementSibling;
const invalidNoVin = validNoVin.nextElementSibling;
const validNoSotk = noSotk.nextElementSibling;
const invalidNoSotk = validNoSotk.nextElementSibling;
const validTahunBerdiri = tahunBerdiri.nextElementSibling;
const invalidTahunBerdiri = validTahunBerdiri.nextElementSibling;
const validTipeInstitusi = tipeInstitusi.nextElementSibling;
const invalidTipeInstitusi = validTipeInstitusi.nextElementSibling;
const validKepemilikan = kepemilikan.nextElementSibling;
const invalidKepemilikan = validKepemilikan.nextElementSibling;
const validStatusBeroperasi = statusBeroperasi.nextElementSibling;
const invalidStatusBeroperasi = validStatusBeroperasi.nextElementSibling;
const validNoTlp = noTlp.nextElementSibling;
const invalidNoTlp = validNoTlp.nextElementSibling;
const validNoFax = noFax.nextElementSibling;
const invalidNoFax = validNoFax.nextElementSibling;
const validEmail = email.nextElementSibling;
const invalidEmail = validEmail.nextElementSibling;
const validWebsite = website.nextElementSibling;
const invalidWebsite = validWebsite.nextElementSibling;
const validDeskripsi = deskripsi.nextElementSibling;
const invalidDeskripsi = validDeskripsi.nextElementSibling;

const btnSimpan = document.getElementById('btn-simpan');

const regexString = /^[a-zA-Z ]+$/;
const regexKombinasi = /^[a-zA-Z ,.']+$/;
const regexSotk = /^[a-zA-Z0-9/']+$/;
const regexNumerik = /^[0-9]+$/;
const regexEmail = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;
const regexNoTlp = /^08\d{10,11}$/;
const regexUrl = /^(https?:\/\/)?(www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(\/\S*)?$/;
let id = sliceUri();

const today = new Date();
const formattedToday = today.toISOString().split('T')[0];
tahunBerdiri.setAttribute('max', formattedToday);

axios.get(`/institute/getInstitute/${id}`)
    .then((response) => {
        if (response.data.success) {
            nama.value = response.data.institutes.nama;
            pimpinan.value = response.data.institutes.pimpinan;
            noVin.value = response.data.institutes.no_vin;
            noSotk.value = response.data.institutes.no_sotk;
            tahunBerdiri.value = response.data.institutes.thn_berdiri;
            tipeInstitusi.value = response.data.institutes.tipe;
            kepemilikan.value = response.data.institutes.kepemilikan;
            statusBeroperasi.value = response.data.institutes.status_beroperasi;
            noTlp.value = response.data.institutes.no_tlp;
            noFax.value = response.data.institutes.no_fax;
            email.value = response.data.institutes.email;
            website.value = response.data.institutes.website;
            deskripsi.value = response.data.institutes.deskripsi;
        } else {
            errorAlert("Gagal dalam mengambil data!");
        }

    })
    .catch(error => {
        errorAlert(error.message);
    })

blurValidate(nama, "Nama Institusi", validNama, invalidNama, null, regexString, 50);
blurValidate(pimpinan, "Nama Pimpinan", validPimpinan, invalidPimpinan, null, regexKombinasi, 50);
blurValidate(noVin, "Nomor VIN", validNoVin, invalidNoVin, null, regexNumerik, 10);
blurValidate(noSotk, "Nomor SOTK dan Tanda Daftar", validNoSotk, invalidNoSotk, null, regexSotk, 20);
blurValidate(tahunBerdiri, "Tahun berdiri", validTahunBerdiri, invalidTahunBerdiri, null, null, 10);
blurValidate(tipeInstitusi, "Tipe Institusi", validTipeInstitusi, invalidTipeInstitusi, null, regexString, 25);
blurValidate(kepemilikan, "Status Kepemilikan", validKepemilikan, invalidKepemilikan, null, null, 25);
blurValidate(statusBeroperasi, "Status Beroperasi", validStatusBeroperasi, invalidStatusBeroperasi, null, null, 16);
blurValidate(noTlp, "Nomor telepon", validNoTlp, invalidNoTlp, null, regexNoTlp, 13);
blurValidate(noFax, "Nomor Fax", validNoFax, invalidNoFax, null, regexNumerik, 5);
blurValidate(email, "Email", validEmail, invalidEmail, null, regexEmail, 50);
blurValidate(website, "Link Website", validWebsite, invalidWebsite, null, regexUrl, 100);
blurValidate(deskripsi, "Deskripsi Institusi", validDeskripsi, invalidDeskripsi, null, regexKombinasi, 255);
btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();

    let isValid = true;
    isValid = onSaveValidate(nama, "Nama Institusi", validNama, invalidNama, null, regexString, 50) && isValid;
    isValid = onSaveValidate(pimpinan, "Nama Pimpinan", validPimpinan, invalidPimpinan, null, regexKombinasi, 50) && isValid;
    isValid = onSaveValidate(noVin, "Nomor VIN", validNoVin, invalidNoVin, null, regexNumerik, 10) && isValid;
    isValid = onSaveValidate(noSotk, "Nomor SOTK dan Tanda Daftar", validNoSotk, invalidNoSotk, null, regexSotk, 20) && isValid;
    isValid = onSaveValidate(tahunBerdiri, "Tahun berdiri", validTahunBerdiri, invalidTahunBerdiri, null, null, 10) && isValid;
    isValid = onSaveValidate(tipeInstitusi, "Tipe Institusi", validTipeInstitusi, invalidTipeInstitusi, null, regexString, 25) && isValid;
    isValid = onSaveValidate(kepemilikan, "Status Kepemilikan", validKepemilikan, invalidKepemilikan, null, null, 25) && isValid;
    isValid = onSaveValidate(statusBeroperasi, "Status Beroperasi", validStatusBeroperasi, invalidStatusBeroperasi, null, null, 16) && isValid;
    isValid = onSaveValidate(noTlp, "Nomor telepon", validNoTlp, invalidNoTlp, null, regexNoTlp, 13) && isValid;
    isValid = onSaveValidate(noFax, "Nomor Fax", validNoFax, invalidNoFax, null, regexNumerik, 5) && isValid;
    isValid = onSaveValidate(email, "Email", validEmail, invalidEmail, null, regexEmail, 50) && isValid;
    isValid = onSaveValidate(website, "Link Website", validWebsite, invalidWebsite, null, regexUrl, 100) && isValid;
    isValid = onSaveValidate(deskripsi, "Deskripsi Institusi", validDeskripsi, invalidDeskripsi, null, regexKombinasi, 255) && isValid;

    if (isValid) {
        questionAlert("Perbarui data?", "Pastikan data telah diperbarui dengan benar!", "Ya, Perbarui", () => {
            axios.post(`/institute/updateInstitute/${id}`, {
                'id': id,
                'nama': nama.value,
                'pimpinan': pimpinan.value,
                'no_vin': noVin.value,
                'no_sotk': noSotk.value,
                'thn_berdiri': tahunBerdiri.value,
                'tipe': tipeInstitusi.value,
                'kepemilikan': kepemilikan.value,
                'status_beroperasi': statusBeroperasi.value,
                'no_tlp': noTlp.value,
                'no_fax': noFax.value,
                'email': email.value,
                'website': website.value,
                'deskripsi': deskripsi.value
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert("Data Berhasil diperbarui!", response.data.redirect_url);
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


