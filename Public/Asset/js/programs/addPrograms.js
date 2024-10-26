const containerList = document.getElementById("container-persyaratan-list");
const btnTambah = document.getElementById("btn-tambah-persyaratan");

const namaProgram = document.getElementById('nama-program');
const namaKejuruan = document.getElementById('nama-kejuruan');
const namaInstruktor = document.getElementById('nama-instruktor');
const statusPendaftaran = document.getElementById('status-pendaftaran');
const gedung = document.getElementById('nama-gedung');
const jmlPeserta = document.getElementById('jml-peserta');
const tglMulaiPendfataran = document.getElementById('tanggal-mulai');
const tglAkhirPendfataran = document.getElementById('tanggal-akhir');
const standarProgram = document.getElementById('standar-program');
const deskripsi = document.getElementById('deskripsi-program');
const syaratProgram = document.getElementById('persyaratan-program');
function tambahPersyaratan() {
    // Membuat elemen container-add-action-control baru
    const newContainer = document.createElement("div");
    newContainer.classList.add("container-add-action-control", "d-flex", "flex-column", "row-gap-1", "mb-3");

    // Menambahkan untuk elemen baru
    newContainer.innerHTML = `
            <div class="container-button-action-control d-flex justify-content-end">
                <button type="button" class="btn btn-hapus-persyaratan">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                </button>
            </div>
            <div class="container-field-persyaratan">
                <input type="text" name="persyaratan-program" class="form-control" id="persyaratan-program" placeholder="Contoh: Minimum Lulusan SMA">
                <div class="valid-feedback" id="valid-feedback-email"></div>
                <div class="invalid-feedback" id="invalid-feedback-email"></div>
            </div>
        `;

    // Menambahkan elemen baru ke dalam containernya
    containerList.appendChild(newContainer);

    // Event listener untuk tombol hapus pada elemen baru
    const btnHapus = newContainer.querySelector(".btn-hapus-persyaratan");
    btnHapus.addEventListener("click", () => {
        newContainer.remove();
    });
}

// Tambahkan event listener ke tombol "Tambah Persyaratan"
btnTambah.addEventListener("click", tambahPersyaratan);