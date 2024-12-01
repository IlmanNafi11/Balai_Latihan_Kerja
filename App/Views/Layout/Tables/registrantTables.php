<div class="tables tables-registration-container px-0 m-0 d-flex flex-column row-gap-3 h-100">
    <div class="tables-topbar d-flex justify-content-end w-100 flex-shrink-1">
        <div class="search-bar-container flex-shrink-1 position-relative">
            <img src="/Asset/images/search-bar-icons.png" alt="search-bar-icons"
                 class="position-absolute icons-searchbar">
            <input id="searchInput" oninput="searchRegistrationData()" type="text" class="search-bar form-control ps-5"
                   placeholder="Cari Data Pendaftar...">
        </div>
    </div>
    <!-- Table -->
    <div class="table-responsive-sm table-responsive-md table-container overflow-y-auto flex-grow-1" id="tableContainer">
        <table class="table table-hover align-middle">
            <thead>
                <tr class="position-sticky top-0" style="z-index: 2 !important;">
                    <td class="number-table-column">No</td>
                    <td class="name-table-column">Nama</td>
                    <td>Program</td>
                    <td>Tahun Registrasi</td>
                    <td>Nomor Registrasi</td>
                    <td>Berkas Pendafataran</td>
                    <td>Status</td>
                    <td class="action-table-column">Aksi</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>