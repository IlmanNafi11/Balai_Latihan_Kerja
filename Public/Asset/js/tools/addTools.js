const name = document.getElementById('nama-alat');
const type = document.getElementById('tipe-alat');
const description = document.getElementById('deskripsi-alat');
btnSimpan = document.getElementById('btn-simpan');
validName = name.nextElementSibling;
invalidName = validName.nextElementSibling;
validType = type.nextElementSibling;
invalidType = validType.nextElementSibling;
validDescription = description.nextElementSibling;
invalidDescription = validDescription.nextElementSibling;

const regex = /^[a-zA-Z0-9 .,]+$/;
blurValidation();
function blurValidation() {
    name.addEventListener('blur', () => {
        name.classList.remove('is-invalid', 'is-valid');
        if (name.value.trim() === '') {
            name.classList.add('is-invalid');
            invalidName.textContent = 'Nama Alat tidak boleh kosong';
        } else if (!regex.test(name.value.trim())) {
            name.classList.add('is-invalid');
            invalidName.textContent = 'Nama Alat tidak valid';
        } else {
            name.classList.add('is-valid')
            validName.textContent = 'Bagus!';
        }
    });

    type.addEventListener('blur', () => {
        type.classList.remove('is-invalid', 'is-valid');
        if (type.value.trim() === '') {
            type.classList.add('is-invalid');
            invalidType.textContent = 'tipe Alat tidak boleh kosong';
        } else if (!regex.test(type.value.trim())) {
            type.classList.add('is-invalid');
            invalidType.textContent = 'tipe Alat tidak valid';
        } else {
            name.classList.add('is-valid')
            validType.textContent = 'Bagus!';
        }
    });

    description.addEventListener('blur', () => {
        description.classList.remove('is-invalid', 'is-valid');
        if (description.value.trim() === '') {
            description.classList.add('is-invalid');
            invalidDescription.textContent = 'deskripsi Alat tidak boleh kosong';
        } else if (!regex.test(description.value.trim())) {
            description.classList.add('is-invalid');
            invalidDescription.textContent = 'deskripsi Alat tidak valid';
        } else {
            name.classList.add('is-valid')
            validName.textContent = 'Bagus!';
        }
    });

    btnSimpan.addEventListener('click', (e) => {
        e.preventDefault();
        let isValid = true;

        name.classList.remove('is-invalid', 'is-valid');
        if (name.value.trim() === '') {
            name.classList.add('is-invalid');
            invalidName.textContent = 'Nama Alat tidak boleh kosong';
            isValid = false;
        } else if (!regex.test(name.value.trim())) {
            name.classList.add('is-invalid');
            invalidName.textContent = 'Nama Alat tidak valid';
            isValid = false;
        } else {
            name.classList.add('is-valid')
            validName.textContent = 'Bagus!';
        }

        type.classList.remove('is-invalid', 'is-valid');
        if (type.value.trim() === '') {
            type.classList.add('is-invalid');
            invalidType.textContent = 'tipe Alat tidak boleh kosong';
            isValid = false;
        } else if (!regex.test(type.value.trim())) {
            type.classList.add('is-invalid');
            invalidType.textContent = 'tipe Alat tidak valid';
            isValid = false;
        } else {
            name.classList.add('is-valid')
            validType.textContent = 'Bagus!';
        }

        description.classList.remove('is-invalid', 'is-valid');
        if (description.value.trim() === '') {
            description.classList.add('is-invalid');
            invalidDescription.textContent = 'deskripsi Alat tidak boleh kosong';
            isValid = false;
        } else if (!regex.test(description.value.trim())) {
            description.classList.add('is-invalid');
            invalidDescription.textContent = 'deskripsi Alat tidak valid';
            isValid = false;
        } else {
            name.classList.add('is-valid')
            validName.textContent = 'Bagus!';
        }

        if (isValid){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }, buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Simpan data?",
                text: "Pastikan semua data telah diisi dengan benar!",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Ya, Simpan",
                cancelButtonText: "Tidak, Batal!",
                reverseButtons: true
            })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios.post(`/tools/addTool`, {
                            'name': name.value,
                            'description': description.value,
                            'type': type.value,
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
}
