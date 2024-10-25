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
let isValid = true;
let id = window.location.pathname.split('/').pop();

const today = new Date();
const formattedToday = today.toISOString().split('T')[0];
tahunBerdiri.setAttribute('max', formattedToday);

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    }, buttonsStyling: false
});

axios.get(`/institute/getInstitute/${id}`)
    .then((response) => {
        nama.value = response.data.dataByID.nama;
        pimpinan.value = response.data.dataByID.pimpinan;
        noVin.value = response.data.dataByID.no_vin;
        noSotk.value = response.data.dataByID.no_sotk;
        tahunBerdiri.value = response.data.dataByID.thn_berdiri;
        tipeInstitusi.value = response.data.dataByID.tipe;
        kepemilikan.value = response.data.dataByID.kepemilikan;
        statusBeroperasi.value = response.data.dataByID.status;
        noTlp.value = response.data.dataByID.no_tlp;
        noFax.value = response.data.dataByID.no_fax;
        email.value = response.data.dataByID.email;
        website.value = response.data.dataByID.website;
        deskripsi.value = response.data.dataByID.deskripsi;
    })
    .catch(error => {
        swalWithBootstrapButtons.fire({
            title: "Gagal!",
            text: error.message,
            icon: "error"
        });
    })

function dateValidate(tgl) {
    if (new Date(tgl) >= today) {
        return false;
    }
    return true;
}

function blurValidate() {
    nama.addEventListener('blur', () => {
        nama.classList.remove('is-invalid', 'is-valid');
        if (nama.value.trim() === '') {
            nama.classList.add('is-invalid');
            invalidNama.textContent = 'Nama Institusi tidak boleh kosong';
            isValid = false;
        } else if (!regexString.test(nama.value.trim())) {
            nama.classList.add('is-invalid');
            invalidNama.textContent = 'Nama institusi tidak valid';
            isValid = false;
        } else {
            nama.classList.add('is-valid')
            validNama.textContent = 'Bagus!';
        }
    });

    pimpinan.addEventListener('blur', () => {
        pimpinan.classList.remove('is-invalid', 'is-valid');
        if (pimpinan.value.trim() === '') {
            pimpinan.classList.add('is-invalid');
            invalidPimpinan.textContent = 'Nama Pimpinan tidak boleh kosong';
            isValid = false;
        } else if (!regexKombinasi.test(pimpinan.value.trim())) {
            pimpinan.classList.add('is-invalid');
            invalidPimpinan.textContent = 'Nama Pimpinan tidak valid';
            isValid = false;
        } else {
            pimpinan.classList.add('is-valid');
            validPimpinan.textContent = 'Bagus!';
        }
    });

    noVin.addEventListener('blur', () => {
        noVin.classList.remove('is-invalid', 'is-valid');
        if (noVin.value.trim() === '') {
            noVin.classList.add('is-invalid');
            invalidNoVin.textContent = 'No Vin tidak boleh kosong';
            isValid = false;
        } else if (!regexNumerik.test(noVin.value.trim())) {
            noVin.classList.add('is-invalid');
            invalidNoVin.textContent = 'Nomor Vin hanya boleh mengandung angka dari 0-9';
        } else {
            noVin.classList.add('is-valid');
            validNoVin.textContent = 'Bagus!';
        }
    });

    noSotk.addEventListener('blur', () => {
        noSotk.classList.remove('is-valid', 'is-invalid');
        if (noSotk.value.trim() === '') {
            noSotk.classList.add('is-invalid');
            invalidNoSotk.textContent = 'Nomor SOTK dan tanda daftar tidak boleh kosong';
            isValid = false;
        } else if (!regexSotk.test(noSotk.value.trim())) {
            noSotk.classList.add('is-invalid');
            invalidNoSotk.textContent = 'Nomor SOTK dan tanda daftar tidak valid';
            isValid = false;
        } else {
            noSotk.classList.add('is-valid');
            validNoSotk.textContent = 'Bagus!';
        }
    });

    tahunBerdiri.addEventListener('blur', () => {
        tahunBerdiri.classList.remove('is-invalid', 'is-valid');
        if (tahunBerdiri.value.trim() === '') {
            tahunBerdiri.classList.add('is-invalid');
            invalidTahunBerdiri.textContent = 'Tahun berdiri tidak boleh kosong';
            isValid = false;
        } else if (!dateValidate(tahunBerdiri.value.trim())) {
            tahunBerdiri.classList.add('is-invalid');
            invalidTahunBerdiri.textContent = 'Tahun berdiri tidak valid';
            isValid = false;
        } else {
            tahunBerdiri.classList.add('is-valid');
            validTahunBerdiri.textContent = 'Bagus!';
        }
    });

    tipeInstitusi.addEventListener('blur', () => {
        tipeInstitusi.classList.remove('is-invalid', 'is-valid');
        if (tipeInstitusi.value.trim() === '') {
            tipeInstitusi.classList.add('is-invalid');
            invalidTipeInstitusi.textContent = 'Tipe Institusi tidak boleh kosong';
            isValid = false;
        } else if (!regexString.test(tipeInstitusi.value.trim())) {
            tipeInstitusi.classList.add('is-invalid');
            invalidTipeInstitusi.textContent = 'Tipe institusi tidak valid';
            isValid = false;
        } else {
            tipeInstitusi.classList.add('is-valid')
            validTipeInstitusi.textContent = 'Bagus!';
        }
    });

    noTlp.addEventListener('blur', () => {
        noTlp.classList.remove('is-invalid', 'is-valid');
        if (noTlp.value.trim() === '') {
            noTlp.classList.add('is-invalid');
            invalidNoTlp.textContent = 'Nomor Telephon tidak boleh kosong';
            isValid = false;
        } else if (!regexNoTlp.test(noTlp.value.trim())) {
            noTlp.classList.add('is-invalid');
            invalidNoTlp.textContent = 'Nomor Telephon tidak valid';
            isValid = false;
        } else {
            noTlp.classList.add('is-valid');
            validNoTlp.textContent = 'Bagus!';
        }
    });

    noFax.addEventListener('blur', () => {
        noFax.classList.remove('is-invalid', 'is-valid');
        if (noFax.value.trim() === '') {
            noFax.classList.add('is-invalid');
            invalidNoFax.textContent = 'Nomor Fax tidak boleh kosong';
            isValid = false;
        } else if (!regexNumerik.test(noFax.value.trim())) {
            noFax.classList.add('is-invalid');
            invalidNoFax.textContent = 'Nomor Fax tidak valid';
            isValid = false;
        } else {
            noFax.classList.add('is-valid');
            validNoFax.textContent = 'Bagus!';
        }
    });

    email.addEventListener('blur', () => {
        email.classList.remove('is-invalid', 'is-valid');
        if (email.value.trim() === '') {
            email.classList.add('is-invalid');
            invalidEmail.textContent = 'Email tidak boleh kosong';
            isValid = false;
        } else if (!regexEmail.test(email.value.trim())) {
            email.classList.add('is-invalid');
            invalidEmail.textContent = 'Email tidak valid';
            isValid = false;
        } else {
            email.classList.add('is-valid');
            validEmail.textContent = 'Bagus!';
        }
    });

    website.addEventListener('blur', () => {
        website.classList.remove('is-valid', 'is-invalid');
        if (website.value.trim() === '') {
            website.classList.add('is-invalid');
            invalidWebsite.textContent = 'URL website tidak boleh kosong';
            isValid = false;
        } else if (!regexUrl.test(website.value.trim())) {
            website.classList.add('is-invalid');
            invalidWebsite.textContent = 'URL tidak valid';
            isValid = false;
        } else {
            website.classList.add('is-valid');
            validWebsite.textContent = 'Bagus!';
        }
    });

    deskripsi.addEventListener('blur', () => {
        deskripsi.classList.remove('is-invalid', 'is-valid');
        if (deskripsi.value.trim() === '') {
            deskripsi.classList.add('is-invalid');
            invalidDeskripsi.textContent = 'Deskripsi tidak boleh kosong';
            isValid = false;
        } else if (!regexKombinasi.test(deskripsi.value.trim())) {
            deskripsi.classList.add('is-invalid');
            invalidDeskripsi.textContent = 'Deskripsi tidak valid';
            isValid = false;
        } else {
            deskripsi.classList.add('is-valid');
            validDeskripsi.textContent = 'Bagus!';
        }
    });

    statusBeroperasi.addEventListener('blur', () => {
        statusBeroperasi.classList.add('is-valid');
        validStatusBeroperasi.textContent = 'Bagus!';
    });

    kepemilikan.addEventListener('blur', () => {
        kepemilikan.classList.add('is-valid');
        validKepemilikan.textContent = 'Bagus!';
    });

    return isValid;
}

blurValidate();

btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();

    nama.classList.remove('is-invalid', 'is-valid');
    if (nama.value.trim() === '') {
        nama.classList.add('is-invalid');
        invalidNama.textContent = 'Nama Institusi tidak boleh kosong';
        isValid = false;
    } else if (!regexString.test(nama.value.trim())) {
        nama.classList.add('is-invalid');
        invalidNama.textContent = 'Nama institusi tidak valid';
        isValid = false;
    } else {
        nama.classList.add('is-valid')
        validNama.textContent = 'Bagus!';
    }

    pimpinan.classList.remove('is-invalid', 'is-valid');
    if (pimpinan.value.trim() === '') {
        pimpinan.classList.add('is-invalid');
        invalidPimpinan.textContent = 'Nama Pimpinan tidak boleh kosong';
        isValid = false;
    } else if (!regexKombinasi.test(pimpinan.value.trim())) {
        pimpinan.classList.add('is-invalid');
        invalidPimpinan.textContent = 'Nama Pimpinan tidak valid';
        isValid = false;
    } else {
        pimpinan.classList.add('is-valid');
        validPimpinan.textContent = 'Bagus!';
    }

    noVin.classList.remove('is-invalid', 'is-valid');
    if (noVin.value.trim() === '') {
        noVin.classList.add('is-invalid');
        invalidNoVin.textContent = 'No Vin tidak boleh kosong';
        isValid = false;
    } else if (!regexNumerik.test(noVin.value.trim())) {
        noVin.classList.add('is-invalid');
        invalidNoVin.textContent = 'Nomor Vin hanya boleh mengandung angka dari 0-9';
    } else {
        noVin.classList.add('is-valid');
        validNoVin.textContent = 'Bagus!';
    }

    noSotk.classList.remove('is-valid', 'is-invalid');
    if (noSotk.value.trim() === '') {
        noSotk.classList.add('is-invalid');
        invalidNoSotk.textContent = 'Nomor SOTK dan tanda daftar tidak boleh kosong';
        isValid = false;
    } else if (!regexSotk.test(noSotk.value.trim())) {
        noSotk.classList.add('is-invalid');
        invalidNoSotk.textContent = 'Nomor SOTK dan tanda daftar tidak valid';
        isValid = false;
    } else {
        noSotk.classList.add('is-valid');
        validNoSotk.textContent = 'Bagus!';
    }

    tahunBerdiri.classList.remove('is-invalid', 'is-valid');
    if (tahunBerdiri.value.trim() === '') {
        tahunBerdiri.classList.add('is-invalid');
        invalidTahunBerdiri.textContent = 'Tahun berdiri tidak boleh kosong';
        isValid = false;
    } else if (!dateValidate(tahunBerdiri.value.trim())) {
        tahunBerdiri.classList.add('is-invalid');
        invalidTahunBerdiri.textContent = 'Tahun berdiri tidak valid';
        isValid = false;
    } else {
        tahunBerdiri.classList.add('is-valid');
        validTahunBerdiri.textContent = 'Bagus!';
    }

    tipeInstitusi.classList.remove('is-invalid', 'is-valid');
    if (tipeInstitusi.value.trim() === '') {
        tipeInstitusi.classList.add('is-invalid');
        invalidTipeInstitusi.textContent = 'Tipe Institusi tidak boleh kosong';
        isValid = false;
    } else if (!regexString.test(tipeInstitusi.value.trim())) {
        tipeInstitusi.classList.add('is-invalid');
        invalidTipeInstitusi.textContent = 'Tipe institusi tidak valid';
        isValid = false;
    } else {
        tipeInstitusi.classList.add('is-valid')
        validTipeInstitusi.textContent = 'Bagus!';
    }

    noTlp.classList.remove('is-invalid', 'is-valid');
    if (noTlp.value.trim() === '') {
        noTlp.classList.add('is-invalid');
        invalidNoTlp.textContent = 'Nomor Telephon tidak boleh kosong';
        isValid = false;
    } else if (!regexNoTlp.test(noTlp.value.trim())) {
        noTlp.classList.add('is-invalid');
        invalidNoTlp.textContent = 'Nomor Telephon tidak valid';
        isValid = false;
    } else {
        noTlp.classList.add('is-valid');
        validNoTlp.textContent = 'Bagus!';
    }

    noFax.classList.remove('is-invalid', 'is-valid');
    if (noFax.value.trim() === '') {
        noFax.classList.add('is-invalid');
        invalidNoFax.textContent = 'Nomor Fax tidak boleh kosong';
        isValid = false;
    } else if (!regexNumerik.test(noFax.value.trim())) {
        noFax.classList.add('is-invalid');
        invalidNoFax.textContent = 'Nomor Fax tidak valid';
        isValid = false;
    } else {
        noFax.classList.add('is-valid');
        validNoFax.textContent = 'Bagus!';
    }

    email.classList.remove('is-invalid', 'is-valid');
    if (email.value.trim() === '') {
        email.classList.add('is-invalid');
        invalidEmail.textContent = 'Email tidak boleh kosong';
        isValid = false;
    } else if (!regexEmail.test(email.value.trim())) {
        email.classList.add('is-invalid');
        invalidEmail.textContent = 'Email tidak valid';
        isValid = false;
    } else {
        email.classList.add('is-valid');
        validEmail.textContent = 'Bagus!';
    }

    website.classList.remove('is-valid', 'is-invalid');
    if (website.value.trim() === '') {
        website.classList.add('is-invalid');
        invalidWebsite.textContent = 'URL website tidak boleh kosong';
        isValid = false;
    } else if (!regexUrl.test(website.value.trim())) {
        website.classList.add('is-invalid');
        invalidWebsite.textContent = 'URL tidak valid';
        isValid = false;
    } else {
        website.classList.add('is-valid');
        validWebsite.textContent = 'Bagus!';
    }

    deskripsi.classList.remove('is-invalid', 'is-valid');
    if (deskripsi.value.trim() === '') {
        deskripsi.classList.add('is-invalid');
        invalidDeskripsi.textContent = 'Deskripsi tidak boleh kosong';
        isValid = false;
    } else if (!regexKombinasi.test(deskripsi.value.trim())) {
        deskripsi.classList.add('is-invalid');
        invalidDeskripsi.textContent = 'Deskripsi tidak valid';
        isValid = false;
    } else {
        deskripsi.classList.add('is-valid');
        validDeskripsi.textContent = 'Bagus!';
    }

    statusBeroperasi.classList.add('is-valid');
    validStatusBeroperasi.textContent = 'Bagus!';

    kepemilikan.classList.add('is-valid');
    validKepemilikan.textContent = 'Bagus!';

    if (isValid){
        swalWithBootstrapButtons.fire({
            title: "Perbarui data?",
            text: "Pastikan semua data telah diisi dengan benar!",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Tidak, Batal!",
            reverseButtons: true
        })
            .then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/institute/updateInstitute/${id}`, {
                        'id': id,
                        'nama': nama.value,
                        'pimpinan': pimpinan.value,
                        'no_vin': noVin.value,
                        'no_sotk': noSotk.value,
                        'thn_berdiri': tahunBerdiri.value,
                        'tipe': tipeInstitusi.value,
                        'kepemilikan': kepemilikan.value,
                        'no_tlp': noTlp.value,
                        'no_fax': noFax.value,
                        'email': email.value,
                        'website': website.value,
                        'deskripsi': deskripsi.value
                    })
                        .then(response => {
                            if (response.data.success) {
                                swalWithBootstrapButtons.fire({
                                    title: "Sukses!",
                                    text: "Data berhasil disimpan!",
                                    icon: "success"
                                })
                                    .then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = response.data.redirect_url;
                                        }
                                    });
                            } else if (response.data.success == false) {
                                swalWithBootstrapButtons.fire({
                                    title: "Gagal!",
                                    text: response.data.message,
                                    icon: "error"
                                });
                            }
                        })
                        .catch(error => {
                            swalWithBootstrapButtons.fire({
                                title: "Gagal!",
                                text: error.message,
                                icon: "error"
                            });
                        });
                }
            })
    }
});


