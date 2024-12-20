<div class="tables tables-institute-container px-0 m-0">
    <div class="table-responsive-sm table-responsive-md">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Pimpinan</td>
                <td>Kepemilikan</td>
                <td>Status</td>
                <td>Email</td>
                <td>Nomor Telepon</td>
                <td>Aksi</td>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($institutes) && !$institutes['isEmpty']) {
                $no = 1;
                foreach ($institutes['institutes'] as $institute):?>
                    <tr id="<?php $institute['id'] ?>">
                        <td><?php echo $no ?></td>
                        <td><?php echo $institute['nama'] ?></td>
                        <td><?php echo $institute['pimpinan'] ?></td>
                        <td><?php echo $institute['kepemilikan'] ?></td>
                        <td><?php echo $institute['status_beroperasi'] ?></td>
                        <td><?php echo $institute['email'] ?></td>
                        <td><?php echo $institute['no_tlp'] ?></td>
                        <td>
                            <a href="/institute/updateInstitute/<?php echo $institute['id'] ?>">
                                <button class="btn btn-warning" name="edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="mx-1 bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd"
                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                    Edit
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php $no++;
                endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="8" class="text-center">Data Kosong</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>