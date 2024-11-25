<!-- Top Navbar -->
<nav class="top-navbar d-flex px-3 py-2 justify-content-between align-items-center">
    <a href="/dashboard" class="text-decoration-none">
        <div class="navbar-title-container d-flex align-items-center column-gap-2 h-100 w-auto">
            <div class="logo-blk-container">
                <img src="/Asset/images/Logo-PelatihanKu-Apps.png" alt="logo BLK">
            </div>
            <div class="navbar-title-container">
                <span class="text-white">PelatihanKu</span>
            </div>
        </div>
    </a>


    <div class="sidebar-navigations d-flex column-gap-3 h-100 align-items-center">
        <a href="/profile/admin/<?php echo $_SESSION['userID'] ?? null ?>">
            <div class="avatar">
                <img class="avatar-img w-100 h-100" src="http://<?= $_SERVER['HTTP_HOST'] . $_SESSION["path_profile"] ?? null ?>" alt="user-profile">
            </div>
        </a>

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
        <a href="/profile/admin/<?php echo $_SESSION['userID'] ?? null ?>">
            <div class="avatar slider-img-avatar overflow-hidden">
                <img class="avatar-img object-fit-cover" src="http://<?= $_SERVER['HTTP_HOST'] . $_SESSION["path_profile"] ?? null ?>" alt="user_profile">
            </div>
        </a>

        <div class="slider-subtitle-profile-container d-flex flex-column align-items-center">
            <h6><?php echo $_SESSION['name'] ?? null ?></h6>
            <span><?php echo $_SESSION['role'] ?? null ?></span>
        </div>
    </div>
    <hr>
    <div class="slider-menu d-flex flex-column flex-grow-1 w-100 px-4">
        <ul class="d-flex flex-column row-gap-2">
            <li class="list-menu">
                <a href="/dashboard"><img src="/Asset/images/dashboard-icons-menu.png" alt="">Beranda</a>
            </li>
            <li class="list-menu">
                <a href="/institute"><img src="/Asset/images/institutes-icons-menu.png" alt="">Kelola Institusi</a>
            </li>
            <li class="list-menu">
                <a href="/department"><img src="/Asset/images/departments-icons-menu.png" alt="">Kelola Kejuruan</a>
            </li>
            <li class="list-menu">
                <a href="/programs"><img src="/Asset/images/programs-icons-menu.png" alt="">Kelola Program</a>
            </li>
            <li class="list-menu">
                <a href="/building"><img src="/Asset/images/buildings-icons-menu.png" alt="">Kelola Gedung</a>
            </li>
            <li class="list-menu">
                <a href="/tools"><img src="/Asset/images/tools-icons-menu.png" alt="">Kelola Alat</a>
            </li>
            <li class="list-menu">
                <a href="/instructor"><img class="me-2" src="/Asset/images/instructors-icons-menu.png" alt="">Kelola Instruktor</a>
            </li>
            <li class="list-menu">
                <a href="/registration"><img src="/Asset/images/registrations-icons-menu.png" alt="">Kelola Pendaftaran</a>
            </li>
            <li class="list-menu">
                <a href="/notification"><img src="/Asset/images/notifications-icons-menu.png" alt="">Kelola Notifikasi</a>
            </li>
            <li class="list-menu">
                <a href="/user"><img src="/Asset/images/usersManagement-icons-menu.png" alt="">Kelola Pengguna</a>
            </li>
        </ul>
    </div>
    <div class="slider-logout-navigations d-flex align-items-center column-gap-2">
        <span class="btn-logout" onclick="logOut()"><Span>Keluar</Span></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-box-arrow-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
            <path fill-rule="evenodd"
                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
        </svg>
    </div>
</div>