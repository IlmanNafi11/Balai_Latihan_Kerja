<div class="tables tables-program-container px-0 m-0">
    <!-- Button add data -->
    <div class="button-add-data-container">
        <a href="/notification/addNotification"><button class="btn btn-primary">+ Tambah Data</button></a>
    </div>
    <!-- Table -->
    <div class="table-responsive-sm table-responsive-md">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Pesan</td>
                    <td>Target</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($notifications)) {
                foreach($notifications as $notification):?>
                <tr>
                    <td><?php echo $notification['id'] ?></td>
                    <td><?php echo $notification['pesan'] ?></td>
                    <td><?php echo $notification['tipe'] ?></td>
                    <td>
                        <a href="#"><button class="btn btn-danger d-flex align-items-center column-gap-1"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                </svg>Hapus</button></a>
                    </td>
                </tr>
            <?php endforeach;
            } else { ?>
            <tr>
                <td colspan="4" class="text-center">Data Kosong</td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>