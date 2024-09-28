<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--    Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Core UI css -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/css/themes/bootstrap/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-72sGGfjIx6qT6nqLY5JXJdwHV+8GR6BXqIJMnei1+xNtrRVP9GM/vFJ3+9345bt/"
        crossorigin="anonymous">

    <!--    Custom Css-->
    <link rel="stylesheet" href="../../Asset/css/style.css">

    <!-- Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <title>Kejuruan | BLK</title>
</head>

<body>
    <!-- ROOT Container -->
    <div class="container-fluid main-root-container w-100 h-100 p-0 m-0">
        <!-- Navbar -->
        <?php require_once '../Layout/navbar.php' ?>

        <div class="container-fluid container-content d-flex flex-column h-auto">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="breadcrumb-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/dashboard.php">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="programs.php">Program</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                </ol>
            </nav>

            <!-- Form -->
            <form action="" method="post" class="d-flex flex-column h-auto">
                <div class="form-program-container d-flex column-gap-4 row-gap-3 h-100 w-100">
                    <!-- Form input 1 -->
                    <div class="container-form-input flex-grow-1 d-flex flex-column row-gap-3">
                        <div class="input-nama-program">
                            <label for="nama-program" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama-program" name="nama-program" placeholder="Contoh: Kuli" required>
                        </div>
                        <div class="input-nama-kejuruan">
                            <label for="nama-kejuruan" class="form-label">Kejuruan</label>
                            <select name="nama-kejuruan" id="nama-kejuruan" class="form-select">
                                <option value="Pilih Kejuruan" selected>Pilih Kejuruan</option>
                                <option value="Teknik Elektro">Teknik Elektro</option>
                                <option value="Teknik Mesin">Teknik Mesin</option>
                                <option value="Teknik Pengelasan">Teknik Pengelasan</option>
                            </select>
                        </div>
                        <div class="input-nama-instruktor">
                            <label for="nama-instruktor" class="form-label">Instruktor</label>
                            <select name="nama-instruktor" id="nama-instruktor" class="form-select">
                                <option value="Pilih Instruktor" selected>Pilih Instruktor</option>
                                <option value="Rigen">Rigen</option>
                                <option value="Rianda">Rianda</option>
                            </select>
                        </div>
                        <div class="input-status-pendaftaran">
                            <label for="status-pendaftaran" class="form-label">Status Pendaftaran</label>
                            <select name="status-pendaftaran" id="status-pendaftaran" class="form-select">
                                <option value="Status" selected>Pilih Status Pendaftaran</option>
                                <option value="Dibuka">Dibuka</option>
                                <option value="Ditutup">Ditutup</option>
                            </select>
                        </div>
                        <div class="input-tanggal-mulai-pendaftaran">
                            <label for="tanggal-mulai" class="form-label">Tanggal Mulai Pendaftaran</label>
                            <input type="date" name="tanggal-mulai" id="tanggal-mulai" class="form-control">
                        </div>
                        <div class="input-tanggal-akhir-pendaftaran">
                            <label for="tanggal-akhir" class="form-label">Tanggal Akhir Pendaftaran</label>
                            <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="form-control">
                        </div>
                        <div class="inpit-persyaratan">
                            <label for="persyaratan-program">Persyaratan Program</label>
                            <div class="container-add-action-control d-flex flex-column">
                                <div class="container-button-action-control d-flex justify-content-end">
                                    <button type="button" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg></button>
                                </div>
                                <div class="container-field-persyaratan">
                                    <input type="text" name="persyaratan-program" id="persyaratan-program"
                                        class="form-control" placeholder="Contoh: Minimum Lulusan SMA">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form input 2 -->
                    <div class="container-form-input flex-grow-1 d-flex flex-column row-gap-3">
                        <div class="input-standar-program">
                            <label for="standar-program" class="form-label">Standar</label>
                            <input type="text" name="standar-program" id="standar-program" class="form-control"
                                placeholder="Contoh: SKKNI">
                        </div>
                        <div class="input-gedung">
                            <label for="gedung" class="form-label">Gedung</label>
                            <select name="gedung" id="gedung" class="form-select">
                                <option value="Status" selected>Pilih Gedung</option>
                                <option value="Gedung Kuli Merdeka">Gedung Kuli Merdeka</option>
                                <option value="Gedung Juang 45">Gedung Juang 45</option>
                            </select>
                        </div>
                        <div class="input-jml-peserta">
                            <label for="jml-peserta" class="form-label">Jumlah Peserta</label>
                            <input type="number" name="jml-peserta" id="jml-peserta" placeholder="Contoh: 144"
                                class="form-control" required>
                        </div>
                        <div class="input-deskripsi-form">
                            <label class="form-label" for="deskripsi-program">Deskripsi</label>
                            <textarea name="deskripsi-program" id="deskripsi-program" class="form-control"
                                placeholder="Contoh : Lorem Ipsum is simply dummy text of the printing and typesetting industry."></textarea>
                        </div>
                        <div
                            class="button-action-container-form my-3 d-flex w-100 h-auto justify-content-end column-gap-2">
                            <a href="#"><button class="btn btn-primary">Simpan</button></a>
                            <a href="programs.php"><button class="btn btn-danger" type="button">Batal</button></a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!--    Bootstrap Js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Core UI Js -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-i+Yu7CmJG/p8FA6Avyg4ZheFvxNjJQ5taj5ArZf94yQt1lWZiVwkXyPrgE/QqbJi"
        crossorigin="anonymous"></script>

    <!-- Custom Js-->
    <script src="../../Asset/js/script.js"></script>

</body>

</html>