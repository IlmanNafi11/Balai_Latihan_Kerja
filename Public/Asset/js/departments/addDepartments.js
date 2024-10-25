const name = document.getElementById('nama-kejuruan');
const description = document.getElementById('deskripsi-kejuruan');
const btnSimpan = document.getElementById('btn-simpan');
const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validDescription = description.nextElementSibling;
const invalidDescription = validDescription.nextElementSibling;
const regex = /^[a-zA-Z0-9 .,]+$/;
let isValid = true;
let instituteId = null;

axios.get('/institute/getInstituteId')
    .then(response => {
        instituteId = response.data.id;
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
                    axios.post(`/department/addDepartment`, {
                        'name': name.value,
                        'description': description.value,
                        'instituteID': instituteId,
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