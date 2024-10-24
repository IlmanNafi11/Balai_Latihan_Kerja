function deleteBuilding(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success', cancelButton: 'btn btn-danger'
        }, buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Hapus data?",
        text: "Data tidak bisa dikembalikan setelah dihapus!",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Tidak, Batal",
        reverseButtons: true
    })
        .then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/building/delete/${id}`)
                    .then(response => {
                        if (response.data.success == true) {
                            swalWithBootstrapButtons.fire({
                                title: "Sukses!",
                                text: "Data berhasil dihapus!",
                                icon: "success"
                            })
                                .then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = response.data.redirect_url;
                                    }
                                })
                        } else if (response.data.success == false) {
                            swalWithBootstrapButtons.fire({
                                title: "Gagal!", text: response.data.message, icon: "error"
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
            } else {
                swalWithBootstrapButtons.fire({
                    title: "Dibatalkan", text: "Data Anda aman :)", icon: "error"
                });
            }
        })
}