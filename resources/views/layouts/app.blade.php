<!doctype html>
<html lang="en">
{{-- ! Heading Start --}}
<x-head />
{{-- ! Heading End --}}

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block"><a href="#" class="nav-link"></a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="./assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow"
                                alt="User Image" />
                            <span class="d-none d-md-inline">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="./assets/img/user2-160x160.jpg" class="rounded-circle shadow"
                                    alt="User Image" />
                                <p>
                                    Admin
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-end">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <aside class="app-sidebar bg-primary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="./index.html" class="brand-link">
                    <i class="fs-2 text-light bi bi-hospital"></i>

                    <span class="brand-text text-light fw-light">Puskesmas SukaHati</span>
                </a>
            </div>

            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                        aria-label="Main navigation" data-accordion="false" id="navigation">
                        <x-link.navlink route="/dashboard" icon="nav-icon fs-4 bi bi-speedometer" menu="Dashboard" />
                        <x-link.navlink route="#" icon="nav-icon fs-4 bi bi-database-fill-add" menu="Master Data"
                            dropdown="true">
                            <li class="nav-item">
                                <a href="{{ url('kelola-desa') }}"
                                    class="nav-link {{ request()->is('kelola-desa') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data Desa</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('kelola-jenis-kelamin') }}"
                                    class="nav-link {{ request()->is('kelola-jenis-kelamin') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data Jenis Kelamin</p>
                                </a>
                            </li>
                        </x-link.navlink>
                        <x-link.navlink route="/kelola-pasien" icon="nav-icon fs-4 bi bi-person-heart"
                            menu="Kelola Pasien" />
                        <x-link.navlink route="/kelola-petugas" icon="nav-icon fs-4 bi bi-person-fill-gear"
                            menu="Kelola Petugas" />
                        <x-link.navlink route="/kelola-rekamedis" icon="nav-icon fs-4 bi bi-heart-pulse-fill"
                            menu="Kelola Rekam Medis" />

                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            {{ $slot }}
        </main>
        <!--end::App Main-->
        {{-- ! Footer Start --}}
        <x-footer />
        {{-- ! Footer End --}}
    </div>
    <x-script />
</body>

</html>