        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/pencari">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-people-arrows"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pencari</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/pencari') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kelola
            </div>

            <!-- Nav Item - User -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pencari.data') }}">
                    <i class="far fa-fw fa-building"></i>
                    <span>Data User</span></a>
            </li>

            <!-- Nav Item - Jenis Pekerhaan -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pencari.lamaran') }}">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Lamaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
