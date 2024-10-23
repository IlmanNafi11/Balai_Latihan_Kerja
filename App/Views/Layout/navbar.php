<!-- Top Navbar -->
<nav class="top-navbar d-flex px-3 py-2 justify-content-between align-items-center">
    <div class="navbar-title-container d-flex align-items-center column-gap-3 h-100 w-auto">
        <div class="logo-blk-container">
            <img src="/Asset/images/logo-blk.png" alt="logo BLK">
        </div>
        <div class="navbar-title-container">
            <span>Balai Latihan Kerja</span>
        </div>
    </div>

    <div class="sidebar-navigations d-flex column-gap-3 h-100 align-items-center">
        <div class="avatar">
            <img class="avatar-img w-100 h-100" src="/Asset/images/me.jpg" alt="user-profile">
        </div>
        <div class="hamburger-menu d-flex flex-column justify-content-evenly p-0 m-0 h-100" id="hamburger-menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </div>
    </div>
</nav>

<!-- Slider Navbar -->
<div class="slider-navigation d-flex flex-column m-0 align-items-center" id="slider-navigation">
    <div class="slider-image-profile-container d-flex flex-column align-items-center row-gap-3 w-100 h-auto">
        <div class="avatar slider-img-avatar overflow-hidden">
            <img class="avatar-img object-fit-cover" src="/Asset/images/me.jpg" alt="user_profile">
        </div>
        <div class="slider-subtitle-profile-container d-flex flex-column align-items-center">
            <h6>Ilman Nafian</h6>
            <span>Administrator</span>
        </div>
    </div>
    <hr>
    <div class="slider-menu d-flex flex-column flex-grow-1 w-100 px-4">
        <ul class="d-flex flex-column row-gap-2">
            <li class="list-menu"><a href="/dashboard">Beranda</a></li>
            <li class="list-menu"><a href="/institute">Kelola Institusi</a></li>
            <li class="list-menu"><a href="/department">Kelola Kejuruan</a></li>
            <li class="list-menu"><a href="/programs">Kelola Program</a></li>
            <li class="list-menu"><a href="/building">Kelola Gedung</a></li>
            <li class="list-menu"><a href="/tools">Kelola Alat</a></li>
            <li class="list-menu"><a href="/instructor">Kelola Instruktor</a></li>
            <li class="list-menu"><a href="/registration">Kelola Pendaftaran</a></li>
            <li class="list-menu"><a href="/notification">Kelola Notifikasi</a></li>
            <li class="list-menu"><a href="/user">Kelola Pengguna</a></li>
        </ul>
    </div>
    <div class="slider-logout-navigations d-flex align-items-center column-gap-2">
        <a href="/logout"><Span>Keluar</Span></a>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-box-arrow-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
            <path fill-rule="evenodd"
                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
        </svg>
    </div>
</div>