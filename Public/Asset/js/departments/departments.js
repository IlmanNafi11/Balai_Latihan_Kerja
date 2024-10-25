const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
});

function deleteDepartments(id) {
    swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Anda tidak akan dapat mengembalikannya!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak, Batal!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/department/delete/${id}`)
                .then((response) => {
                    if (response.data.success) {
                        swalWithBootstrapButtons.fire({
                            title: "Dihapus!",
                            text: "Data telah dihapus",
                            icon: "success"
                        })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.data.redirect_url;
                                }
                            });
                    } else if (response.data.success == false) {
                        swalWithBootstrapButtons.fire({
                            title: "Gagal",
                            text: result.data.message,
                            icon: "error"
                        });
                    }
                })
                .catch((error) => {
                    swalWithBootstrapButtons.fire({
                        title: "Gagal",
                        text: error.message,
                        icon: "error"
                    });
                });
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Dibatalkan",
                text: "Data anda aman :)",
                icon: "error"
            });
        }
    });
}