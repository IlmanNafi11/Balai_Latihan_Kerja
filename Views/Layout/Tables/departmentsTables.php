<div class="tables tables-department-container px-0 m-0">
    <!-- Button add data -->
    <div class="button-add-data-container">
        <a href="addDepartments.php">
            <button class="btn btn-primary">+ Tambah Data</button>
        </a>
    </div>
    <!-- Table -->
    <div class="table-responsive-sm table-responsive-md">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Deskripsi</td>
                <td>Aksi</td>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($department)) {
                foreach ($department

                         as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td>
                            <a href="updateDepartments.php?id=<?= $row['id'] ?>">
                                <button class="btn btn-warning">Ubah</button>
                            </a>
                            <a href="#">
                                <button class="btn btn-danger">Hapus</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;
            } else { ?>
                <tr>
                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>