<div class="tables tables-program-container px-0 m-0 d-flex flex-column row-gap-3 h-100">
    <div class="tables-topbar d-flex justify-content-between row-gap-3 w-100 flex-shrink-1">
        <div class="button-add-data-container flex-grow-1">
            <a href="programs/add">
                <button class="btn btn-primary">+ Tambah Data</button>
            </a>
        </div>
        <div class="search-bar-container flex-shrink-1 position-relative">
            <img src="/Asset/images/search-bar-icons.png" alt="search-bar-icons" class="position-absolute icons-searchbar">
            <input id="searchInput" oninput="searchPrograms()" type="text" class="search-bar form-control ps-5" placeholder="Cari Program...">
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive-sm table-responsive-md table-container overflow-y-auto flex-grow-1">
        <table class="table table-hover align-middle">
            <thead>
            <tr class="position-sticky top-0">
                <td class="number-table-column">No</td>
                <td>Nama</td>
                <td>Kejuruan</td>
                <td>Instruktor</td>
                <td>Gedung</td>
                <td>Peserta</td>
                <td class="action-table-column">Aksi</td>
            </tr>
            </thead>
            <tbody>
                <!-- Data -->
            </tbody>
        </table>
    </div>
</div>