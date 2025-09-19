        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="<?php echo base_url('dashboard/home') ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo base_url('assets/img/perpus') ?>/logo-perpus.png" style="height:60px">
                </div>
                <div class="sidebar-brand-text mx-3">BMN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard/home') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Data Barang Perpus
            </div>

            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard/barang/add') ?>">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Tambah Barang</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard/barang') ?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>list</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Daftar Barang Ruangan (DBR)
            </div>

            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard/dbr/add') ?>">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Tambah DBR</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard/dbr') ?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>list</span></a>
            </li>


            <div class="sidebar-heading">
                Setting
            </div>
            <!-- Nav Item list user -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard/user') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->