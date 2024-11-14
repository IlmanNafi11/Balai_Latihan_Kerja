<div class="tables tables-instructors-container px-0 m-0 d-flex flex-column row-gap-3 h-100">
    <div class="tables-topbar d-flex justify-content-between row-gap-3 w-100 flex-shrink-1">
        <div class="button-add-data-container">
            <a href="/instructor/add">
                <button class="btn btn-primary">+ Tambah Data</button>
            </a>
        </div>
        <div class="search-bar-container flex-shrink-1 position-relative">
            <img src="/Asset/images/search-bar-icons.png" alt="search-bar-icons"
                 class="position-absolute icons-searchbar">
            <input id="searchInput" oninput="searchInstructor()" type="text" class="search-bar form-control ps-5"
                   placeholder="Cari Instruktor...">
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive-sm table-responsive-md table-container overflow-y-auto flex-grow-1"
         id="tableContainer">
        <table class="table table-hover align-middle">
            <thead>
            <tr class="position-sticky top-0" style="z-index: 2 !important;">
                <td class="number-table-column">No</td>
                <td class="name-table-column">Nama</td>
                <td>Nomor Telepon</td>
                <td>Email</td>
                <td>Alamat</td>
                <td>Pas Foto</td>
                <td class="action-table-column">Aksi</td>
            </tr>
            </thead>
            <tbody>
            <!-- Data -->
            </tbody>
        </table>
    </div>
</div>