const name = document.getElementById('nama-kejuruan');
const description = document.getElementById('deskripsi-kejuruan');
const btnSimpan = document.getElementById('btn-simpan');
const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validDescription = description.nextElementSibling;
const invalidDescription = validDescription.nextElementSibling;
const regex = /^[a-zA-Z0-9 .,]+$/;
let isValid = true;
let id = window.location.pathname.split('/').pop();

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    }, buttonsStyling: false
});

axios.get(`/department/getDepartment/${id}`)
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
        console.log(error);
    });

btnSimpan.addEventListener('click', (e) => {
    e.preventDefault();
    name.classList.remove('is-invalid', 'is-valid');
    if (name.value.trim() === '') {
        name.classList.add('is-invalid');
        invalidName.textContent = 'Nama Kejuruan tidak boleh kosong';
        isValid = false;
    } else if (!regex.test(name.value.trim())) {
        name.classList.add('is-invalid');
        invalidName.textContent = 'Nama Kejuruan tidak valid';
        isValid = false;
    } else {
        name.classList.add('is-valid')
        validName.textContent = 'Bagus!';
    }

    description.classList.remove('is-invalid', 'is-valid');
    if (description.value.trim() === '') {
        description.classList.add('is-invalid');
        invalidDescription.textContent = 'Deskripsi Kejuruan tidak boleh kosong';
        isValid = false;
    } else if (!regex.test(description.value.trim())) {
        description.classList.add('is-invalid');
        invalidDescription.textContent = 'Deskripsi Kejuruan tidak valid';
        isValid = false;
    } else {
        name.classList.add('is-valid')
        validName.textContent = 'Bagus!';
    }

    if (isValid && blurValidate()){
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
                    axios.post(`/department/updateDepartment/${id}`, {
                        'name': name.value,
                        'description': description.value,
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

function blurValidate() {
    name.classList.remove('is-invalid', 'is-valid');
    if (name.value.trim() === '') {
        name.classList.add('is-invalid');
        invalidName.textContent = 'Nama Kejuruan tidak boleh kosong';
        isValid = false;
    } else if (!regex.test(name.value.trim())) {
        name.classList.add('is-invalid');
        invalidName.textContent = 'Nama Kejuruan tidak valid';
        isValid = false;
    } else {
        name.classList.add('is-valid')
        validName.textContent = 'Bagus!';
    }

    description.classList.remove('is-invalid', 'is-valid');
    if (description.value.trim() === '') {
        description.classList.add('is-invalid');
        invalidDescription.textContent = 'Deskripsi Kejuruan tidak boleh kosong';
        isValid = false;
    } else if (!regex.test(description.value.trim())) {
        description.classList.add('is-invalid');
        invalidDescription.textContent = 'Deskripsi Kejuruan tidak valid';
        isValid = false;
    } else {
        name.classList.add('is-valid')
        validName.textContent = 'Bagus!';
    }
    return isValid;
}