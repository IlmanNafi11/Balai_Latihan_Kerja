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
    <link rel="stylesheet" href="/Asset/css/style.css">

    <!-- Font -->
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">

    <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet">

    <title>Institutsi | BLK</title>
</head>

<body>
<!-- ROOT Container -->
<div class="container-fluid main-root-container w-100 h-100 p-0 m-0">
    <!-- Navbar -->
    <?php require_once '../App/Views/Layout/navbar.php'; ?>

    <!-- Container Content -->
    <div class="container-fluid container-content d-flex flex-column h-auto">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-beranda">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/institute">Kelola Institusi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
            </ol>
        </nav>

        <!-- Form -->
        <form method="post" class="d-flex flex-column h-100 w-100 form-control">
            <div class="form-institute-container d-flex column-gap-4 h-auto w-100">
                <!-- Form input 1 -->
                <div class="container-form-input flex-grow-1">
                    <div class="input-nama mb-3">
                        <label class="form-label" for="nama-institusi">Nama</label>
                        <input type="text" name="nama-institusi" id="nama-institusi" class="form-control"
                               placeholder="Contoh: UPT BLK Nganjuk">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-pimpinan mb-3">
                        <label class="form-label" for="nama-pimpinan">Pimpinan</label>
                        <input type="text" name="nama-pimpinan" id="nama-pimpinan" class="form-control"
                               placeholder="Contoh: Aziz Harnowo, SP., M.A.P">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-nomor-vin mb-3">
                        <label class="form-label" for="nomor-vin">Nomor VIN</label>
                        <input type="number" name="nomor-vin" id="nomor-vin" class="form-control"
                               placeholder="Contoh: 1903351802">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-sotk mb-3">
                        <label class="form-label" for="nomor-sotk">Nomor SOTK dan Tanda Daftar</label>
                        <input type="text" name="nomor-sotk" id="nomor-sotk" class="form-control"
                               placeholder="Contoh : NO/62/TAHUN/2018">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-tahun-berdiri mb-3">
                        <label class="form-label" for="tahun-berdiri">Tahun Berdiri</label>
                        <input type="date" name="tahun-berdiri" id="tahun-berdiri" class="form-control">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-tipe-institusi mb-3">
                        <label class="form-label" for="tipe-institusi">Tipe Institusi</label>
                        <input type="text" name="tipe-institusi" id="tipe-institusi" class="form-control"
                               placeholder="Contoh : UPT BLK">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-kepemilikan mb-3">
                        <label class="form-label" for="kepemilikan-institusi">Kepemilikan</label>
                        <select class="form-select" name="kepemilikan-institusi" id="kepemilikan-institusi">
                            <option value="Pemerintah">Pemerintah</option>
                            <option value="Swasta/Perorangan">Swasta/Perorangan</option>
                        </select>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <!-- Form input 2 -->
                <div class="container-form-input flex-grow-1 d-flex flex-column">
                    <div class="input-status-beroperasi mb-3">
                        <label class="form-label" for="status-beroperasi">Status Beroperasi</label>
                        <select class="input-status-beroperasi form-select" name="status-beroperasi"
                                id="status-beroperasi">
                            <option value="Beroperasi">Beroperasi</option>
                            <option value="Tidak Beroperasi">Tidak Beroperasi</option>
                        </select>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-telepon-institusi mb-3">
                        <label class="form-label" for="telepon-institusi">Nomor Telepon</label>
                        <input type="number" name="telepon-institusi" id="telepon-institusi" class="form-control"
                               placeholder="Contoh: 08xxxxxxxx">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-nomor-fax mb-3">
                        <label class="form-label" for="nomor-fax">Nomor Fax</label>
                        <input type="number" name="nomor-fax" id="nomor-fax" class="form-control"
                               placeholder="Contoh: 144">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-email-institusi mb-3">
                        <label class="form-label" for="email-institusi">Email</label>
                        <input type="email" name="email-institusi" id="email-institusi" class="form-control"
                               placeholder="Contoh: blk@blk.com">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-link-website mb-3">
                        <label class="form-label" for="link-website">Website</label>
                        <input type="url" name="link-website" id="link-website" class="form-control"
                               placeholder="Contoh : https://kelembagaan.kemnaker.go.id/">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-deskripsi-form flex-grow-1 d-flex flex-column">
                        <label class="form-label" for="deskripsi-institusi">Deskripsi</label>
                        <textarea name="deskripsi-institusi" id="deskripsi-institusi"
                                  class="form-control flex-grow-1"
                                  placeholder="Contoh : Lorem Ipsum is simply dummy text of the printing and typesetting industry."></textarea>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="button-action-container-form my-3 d-flex w-100 h-auto justify-content-end column-gap-2">
                <button class="btn btn-primary" id="btn-simpan">Simpan</button>
                <a href="/institute">
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

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Logic Handler -->
<script type="module" src="/Asset/js/institutes/updateInstitutes.js"></script>

</body>

</html>