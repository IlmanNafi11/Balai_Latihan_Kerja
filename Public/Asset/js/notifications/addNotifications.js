const message = document.getElementById('pesan-notifikasi');
const btnSimpan = document.getElementById('btn-simpan');
const validMessage = message.nextElementSibling;
const invalidMessage = validMessage.nextElementSibling;
const regex = /^[a-zA-Z0-9 .,]+$/;

btnSimpan.addEventListener('click', e => {
    e.preventDefault();
    let isValid = true;
    message.classList.remove('is-invalid', 'is-valid');
    if (message.value.trim() === '') {
        isValid = false;
        message.classList.add('is-invalid');
        invalidMessage.textContent = 'Pesan notifikasi tidak boleh kosong';
    } else if (!regex.test(message.value.trim())) {
        isValid = false;
        message.classList.add('is-invalid');
        invalidMessage.textContent = 'Pesan notifikasi tidak valid';
    } else {
        message.classList.add('is-valid');
        validMessage.textContent = 'Bagus!';
    }

    if (isValid) {
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
                    axios.post(`/notification/addNotification`, {
                        'message': message.value,
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