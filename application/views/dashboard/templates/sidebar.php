<!-- Sidebar -->

<?php
$roleID = $this->session->userdata('role_id'); //variabel untuk mengambil role user dari session

$menus = $this->menu_model->get_user_menus($roleID);  //list access menu berdasarkan role user login  
?>


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
    <?php
    // Fungsi rekursif untuk membangun menu
    function build_menu($menus, $parent_id = 0)
    {
        $has_children = false;
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parent_id) {
                if (!$has_children) {
                    echo '<li class="nav-item active">
                        <a class="nav-link" href="' . base_url() . $menu['url'] . '">
                          <i class="' . $menu['icon'] . '"></i>
                         <span>' . $menu['menu_name'] . '</span></a>
                         </li>';
                } else { // jika tidak ada child
                    //
                }
            }
        }
    }

    // Tampilkan menu utama (parent_id = 0)
    foreach ($menus as $menu) {
        if ($menu['parent_id'] == 0 && $menu['url'] !== '#') { ?>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url() ?>">
                    <i class="<?php echo $menu['icon'] ?> "></i>
                    <span><?php echo $menu['menu_name'] ?></span></a>
            </li>

        <?php } else if ($menu['parent_id'] == 0) { ?>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                <?php echo $menu['menu_name'] ?>
            </div>
            <?php build_menu($menus, $menu['id']); ?>

    <?php }
    }
    ?>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->