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

    <!-- CSS untuk Daterangepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <!--    Custom Css-->
    <link rel="stylesheet" href="/Asset/css/style.css">

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
    <?php require_once '../App/Views/Layout/navbar.php' ?>

    <div class="container-fluid container-content d-flex flex-column h-auto">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/programs">Program</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
            </ol>
        </nav>

        <!-- Form -->
        <form class="d-flex flex-column h-auto form-programs" id="form-add-programs">
            <div class="form-program-container d-flex column-gap-4 row-gap-3 h-100 w-100">
                <!-- Form input 1 -->
                <div class="container-form-input flex-grow-1 d-flex flex-column row-gap-3">
                    <div class="input-nama-program">
                        <label for="nama-program" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama-program" name="nama-program"
                               placeholder="Contoh: Kuli">
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-nama-kejuruan">
                        <label for="nama-kejuruan" class="form-label">Kejuruan</label>
                        <select name="nama-kejuruan" id="nama-kejuruan" class="form-select">
                            <option value="Pilih Kejuruan" selected disabled>Pilih Kejuruan</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Pengelasan">Teknik Pengelasan</option>
                        </select>
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-nama-instruktor">
                        <label for="nama-instruktor" class="form-label">Instruktor</label>
                        <select name="nama-instruktor" id="nama-instruktor" class="form-select">
                            <option value="Pilih Instruktor" selected disabled>Pilih Instruktor</option>
                            <option value="Rigen">Rigen</option>
                            <option value="Rianda">Rianda</option>
                        </select>
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-gedung">
                        <label for="gedung" class="form-label">Gedung</label>
                        <select name="gedung" id="nama-gedung" class="form-select">
                            <option value="Status" selected disabled>Pilih Gedung</option>
                            <option value="Gedung Kuli Merdeka">Gedung Kuli Merdeka</option>
                            <option value="Gedung Juang 45">Gedung Juang 45</option>
                        </select>
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-jml-peserta">
                        <label for="jml-peserta" class="form-label">Jumlah Peserta</label>
                        <input type="number" name="jml-peserta" id="jml-peserta" placeholder="Contoh: 144"
                               class="form-control">
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-foto flex-grow-1 d-flex flex-column">
                        <label for="fileInput" class="form-label">Foto Kejuruan</label>
                        <div class="upload-area w-100 m-0 p-3 flex-grow-1 d-flex flex-column align-items-center justify-content-center"
                             style="height: 150px"
                             id="upload-area">
                            <img src="/Asset/images/upload_icons.png" alt="upload icon" id="uploadIcon"/>
                            <p id="uploadText">Upload file</p>
                            <small id="formatText">*jpg, png</small>
                            <input type="file" id="fileInput" accept=".jpg,.jpeg,.png" style="display: none"/>
                        </div>
                        <div class="valid-feedback" id="valid-feedback"></div>
                        <div class="invalid-feedback" id="invalid-feedback"></div>
                    </div>
                </div>
                <!-- Form input 2 -->
                <div class="container-form-input flex-grow-1 d-flex flex-column row-gap-3">
                    <div class="input-status-pendaftaran">
                        <label for="status-pendaftaran" class="form-label">Status Pendaftaran</label>
                        <select name="status-pendaftaran" id="status-pendaftaran" class="form-select">
                            <option value="status" selected disabled>Pilih Status Pendaftaran</option>
                            <option value="Dibuka">Dibuka</option>
                            <option value="Ditutup">Ditutup</option>
                        </select>
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-tanggal-mulai-pendaftaran">
                        <label for="tanggal-mulai" class="form-label">Tanggal Mulai Pendaftaran</label>
                        <input type="date" name="tanggal-mulai" id="tanggal-mulai" class="form-control">
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-tanggal-akhir-pendaftaran">
                        <label for="tanggal-akhir" class="form-label">Tanggal Akhir Pendaftaran</label>
                        <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="form-control">
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-standar-program">
                        <label for="standar-program" class="form-label">Standar</label>
                        <input type="text" name="standar-program" id="standar-program" class="form-control"
                               placeholder="Contoh: SKKNI">
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-deskripsi-form flex-grow-1 flex-shrink-0 d-flex flex-column">
                        <label class="form-label" for="deskripsi-program">Deskripsi</label>
                        <textarea name="deskripsi-program" id="deskripsi-program" class="form-control flex-grow-1"
                                  placeholder="Contoh : Lorem Ipsum is simply dummy text of the printing and typesetting industry."></textarea>
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="input-persyaratan">
                        <label class="form-label" for="persyaratan-program">Persyaratan Program</label>
                        <div id="container-persyaratan-list" class="d-flex flex-column row-gap-1">
                            <!-- Elemen container-add-action-control -->
                        </div>
                        <div class="container-button-add">
                            <button type="button"
                                    class="btn btn-success w-100 d-flex align-items-center justify-content-center"
                                    id="btn-tambah-persyaratan">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                Tambah Persyaratan
                            </button>
                            <div class="valid-feedback" id="valid-feedback-email"></div>
                            <div class="invalid-feedback" id="invalid-feedback-email"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                    class="button-action-container-form my-3 d-flex w-100 h-auto justify-content-end column-gap-2">
                <button class="btn btn-primary" id="btn-simpan" type="button">Simpan</button>
                <a href="/programs">
                    <button class="btn btn-danger" type="button">Batal</button>
                </a>
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
<script src="/Asset/js/script.js"></script>

<!-- AXIOS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Logic Handler -->
<script type="module" src="/Asset/js/programs/addPrograms.js"></script>

</body>

</html>