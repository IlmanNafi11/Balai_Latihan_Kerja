<div class="tables tables-program-container px-0 m-0 d-flex flex-column row-gap-3 h-100">
    <div class="tables-topbar d-flex justify-content-between row-gap-3 w-100 flex-shrink-1">
        <div class="button-add-data-container">
            <a href="/notification/add">
                <button class="btn btn-primary">+ Tambah Data</button>
            </a>
        </div>
        <div class="search-bar-container flex-shrink-1 position-relative">
            <img src="/Asset/images/search-bar-icons.png" alt="search-bar-icons"
                 class="position-absolute icons-searchbar">
            <input id="searchInput" oninput="searchNotifications()" type="text" class="search-bar form-control ps-5"
                   placeholder="Cari Notifikasi...">
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive-sm table-responsive-md table-container overflow-y-auto flex-grow-1"
         id="tableContainer">
        <table class="table table-hover align-middle">
            <thead>
            <tr class="position-sticky top-0">
                <td class="number-table-column">No</td>
                <td>Pesan</td>
                <td class="target-notification-table-column">Target</td>
                <td class="action-table-column">Aksi</td>
            </tr>
            </thead>
            <tbody>
            <!-- Data -->
            </tbody>
        </table>
    </div>
</div>