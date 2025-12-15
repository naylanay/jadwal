<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-user-astronaut"></i>
                </div>
                <div class="sidebar-brand-text mx-3">WPN Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider ">

            <!-- QUERY MENU -->
             <?php 
             $role_id = $this->session->userdata('role_id');
             $queryMenu = "SELECT `user_menu` . `id`, `menu`
                            FROM `user_menu` 
                            JOIN `user_access_menu` ON `user_menu` . `id` = `user_access_menu`.`menu_id` 
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC
                            ";
            $menu = $this->db->query($queryMenu)->result_array();
            
            
             ?>

            <!-- LOOOPING MENU -->
             <?php foreach ($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu'];?>
            </div>

            <!-- SIAPKAN SUB MENU SESUAI MENU -->
             <?php
             $menuId = $m['id'];
             $querySubMenu = "SELECT *
                                FROM `user_sub_menu`  
                                JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                                ";
            $subMenu = $this->db->query($querySubMenu)->result_array();

             ?>

                <?php foreach ($subMenu as $sm) : ?>
                <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>

                <?php endforeach; ?>

            <hr class="sidebar-divider mt-3">

            <?php endforeach; ?>


            <!-- Divider -->
            <hr class="sidebar-divider">

            
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="fa-solid fa-fw fa-right-from-bracket"></i>
                    <span>Logout</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="d-flex justify-content-center my-3">
                <button class="rounded-circle border-0" id="sidebarToggle">
                </button>
            </div>
            <!-- jQuery (WAJIB DULUAN) -->
            <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

            <!-- Bootstrap -->
            <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Plugin lainnya -->
            <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom Template JS -->
            <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>


        </ul>
        <!-- End of Sidebar -->