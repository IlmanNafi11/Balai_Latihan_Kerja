<div class="tables tables-program-container px-0 m-0">
    <!-- Button add data -->
    <div class="button-add-data-container">
        <a href="user/create">
            <button class="btn btn-primary">+ Tambah Admin</button>
        </a>
    </div>
    <!-- Table -->
    <div class="table-responsive-sm table-responsive-md">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>No Telepon</td>
                <td>Email</td>
                <td>Tempat, Tanggal Lahir</td>
                <td>Alamat</td>
                <td>Pas Foto</td>
                <td>Aksi</td>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($users) && !$users['isEmpty']) {
                $no = 1;
                foreach ($users['users'] as $user):
                    ?>
                    <tr id="<?php echo $no ?>">
                        <td><?php echo $no ?></td>
                        <td><?php echo $user['nama'] ?></td>
                        <td><?php echo $user['tlp'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['tanggal_lahir'] ?></td>
                        <td><?php echo $user['alamat'] ?></td>
                        <td>
                            <div class="avatar avatar-instruktor">
                                <img class="avatar-img w-100 h-100" src="<?php echo $user['profile_picture'] ?>"
                                     alt="user@email.com">
                            </div>
                        </td>
                        <td>
                            <button onclick="deleteUser(<?php echo $user['id']?>)" class="btn btn-danger d-flex align-items-center column-gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     fill="currentColor"
                                     class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                                Hapus
                            </button>
                        </td>
                    </tr>
                    <?php $no++;
                endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="8"><?php echo $users['message'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>