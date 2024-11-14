<div class="tables tables-list-users-container d-flex flex-column h-100 overflow-hidden row-gap-3">
    <div class="container-table-admin main-container-table px-0 m-0 d-flex flex-column row-gap-3 overflow-y-hidden" id="main-container-table-admin">
        <div class="tables-topbar d-flex justify-content-between row-gap-3 w-100 flex-shrink-1 pt-2 pe-2">
            <div class="button-add-data-container flex-grow-1">
                <a href="/user/admin/add">
                    <button class="btn btn-primary">+ Tambah Admin</button>
                </a>
            </div>
            <div class="search-bar-container flex-shrink-1 position-relative">
                <img src="/Asset/images/search-bar-icons.png" alt="search-bar-icons"
                     class="position-absolute icons-searchbar">
                <input id="searchAdminInput" oninput="searchAdminUsers()" type="text"
                       class="search-bar form-control ps-5" placeholder="Cari Admin...">
            </div>
        </div>
        <span class="table-title">Daftar Admin</span>
        <div class="table-responsive-sm table-responsive-md table-container mh-100 flex-grow-1 overflow-y-auto"
             id="adminTableContainer">
            <table class="table table-hover align-middle w-100 caption-top h-auto">
                <thead>
                <tr class="position-sticky top-0" style="z-index: 1">
                    <td class="number-table-column">No</td>
                    <td class="name-table-column">Nama</td>
                    <td>No Telepon</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Pas Foto</td>
                    <td class="action-table-column">Aksi</td>
                </tr>
                </thead>
                <tbody id="adminTableBody">
                <!-- Data -->
                </tbody>
            </table>
        </div>
    </div>

    <div class="container-table-pengguna main-container-table px-0 m-0 d-flex flex-column row-gap-3 overflow-y-hidden" id="main-container-table-pengguna">
        <div class="tables-topbar tables-topbar-pengguna d-flex justify-content-between align-items-center row-gap-3 w-100 pt-2 pe-2">
            <span class="table-title">Daftar Pengguna</span>
            <div class="search-bar-container flex-shrink-1 position-relative">
                <img src="/Asset/images/search-bar-icons.png" alt="search-bar-icons"
                     class="position-absolute icons-searchbar">
                <input id="searchPenggunaInput" oninput="searchPenggunaUsers()" type="text"
                       class="search-bar form-control ps-5" placeholder="Cari Pengguna...">
            </div>
        </div>
        <div class="table-responsive-sm table-responsive-md table-container mh-100 flex-grow-1 overflow-y-auto"
             id="penggunaTableContainer">
            <table class="table table-hover align-middle caption-top w-100 h-auto">
                <thead>
                <tr class="position-sticky top-0" style="z-index: 1">
                    <td class="number-table-column">No</td>
                    <td class="name-table-column">Nama</td>
                    <td>No Telepon</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Pas Foto</td>
                    <td class="action-table-column">Aksi</td>
                </tr>
                </thead>
                <tbody id="penggunaTableBody">
                <!-- Data -->
                </tbody>
            </table>
        </div>
    </div>

</div>
