const name = document.getElementById('nama-gedung');
const description = document.getElementById('deskripsi-gedung');
const btnSimpan = document.getElementById('btn-simpan');

const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validDescription = description.nextElementSibling;
const invalidDescription = validDescription.nextElementSibling;
let isValid = true;
const regexName = /^[a-zA-Z0-9 ]+$/;
const regexDecrp = /^[a-zA-Z0-9 ,.]+$/;

let id = window.location.pathname.split('/').pop();
axios.get(`/building/getBuilding/${id}`)
    .then(response => {
        if (response.data.success) {
            name.value = response.data.dataByID.nama;
            description.value = response.data.dataByID.deskripsi;
        } else {
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
    })

validate();
btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();
    isValid = true;
    name.classList.remove('is-valid', 'is-invalid');
    if (name.value.trim() === '') {
        name.classList.add('is-invalid');
        invalidName.textContent = 'Nama gedung tidak boleh kosong';
        isValid = false;
    } else if (!regexName.test(name.value.trim())) {
        name.classList.add('is-invalid');
        invalidName.textContent = 'Nama gedung tidak valid';
        isValid = false;
    } else {
        name.classList.add('is-valid');
        validName.textContent = 'Bagus!';
    }

    description.classList.remove('is-valid', 'is-invalid');
    if (description.value.trim() === '') {
        description.classList.add('is-invalid');
        invalidDescription.textContent = 'Deskripsi gedung tidak boleh kosong';
        isValid = false;
    } else if (!regexDecrp.test(description.value.trim())) {
        description.classList.add('is-invalid');
        invalidDescription.textContent = 'Deskripsi gedung tidak valid';
        isValid = false;
    } else {
        description.classList.add('is-valid');
        validDescription.textContent = 'Bagus!';
    }

    if (isValid) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            }, buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Perbarui data?",
            text: "Pastikan semua data telah diisi dengan benar!",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Perbarui",
            cancelButtonText: "Tidak, Batal!",
            reverseButtons: true
        })
            .then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/building/updateBuilding/${id}`, {
                        'name': name.value.trim(),
                        'description': description.value.trim(),
                    })
                        .then(response => {
                            if (response.data.success) {
                                swalWithBootstrapButtons.fire({
                                    title: "Sukses!",
                                    text: "Data berhasil diperbarui!",
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

function validate() {
    name.addEventListener('blur', () => {
        name.classList.remove('is-valid', 'is-invalid');
        if (name.value.trim() === '') {
            name.classList.add('is-invalid');
            invalidName.textContent = 'Nama gedung tidak boleh kosong';
        } else if (!regexName.test(name.value.trim())) {
            name.classList.add('is-invalid');
            invalidName.textContent = 'Nama gedung tidak valid';
        } else {
            name.classList.add('is-valid');
            validName.textContent = 'Bagus!';
        }
    });

    description.addEventListener('blur', () => {
        description.classList.remove('is-valid', 'is-invalid');
        if (description.value.trim() === '') {
            description.classList.add('is-invalid');
            invalidDescription.textContent = 'Deskripsi gedung tidak boleh kosong';
        } else if (!regexDecrp.test(description.value.trim())) {
            description.classList.add('is-invalid');
            invalidDescription.textContent = 'Deskripsi gedung tidak valid';
        } else {
            description.classList.add('is-valid');
            validDescription.textContent = 'Bagus!';
        }
    });
}
