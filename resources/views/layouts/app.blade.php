<!doctype html>
<html lang="en">
{{-- ! Heading Start --}}
<x-head />
{{-- ! Heading End --}}

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand modern-navbar">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link sidebar-toggle-btn" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>

                <!--begin::User Menu-->
                <div class="navbar-user-section ms-auto d-flex align-items-center">
                    <div class="user-greeting me-3">
                        <span class="greeting-text">Halo, </span>
                        <span class="greeting-name">{{ Auth::user()->username ?? 'User' }}!</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="d-none d-md-inline">Logout</span>
                        </button>
                    </form>
                </div>
                <!--end::User Menu-->
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
