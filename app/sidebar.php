<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['nama'].' | '.$_SESSION['level'];?></a>
        </div>
    </div>

    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="index.php?page=dashboard" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Widgets
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>

            <?php
            // Pastikan user_id tersedia di sesi
            $current_user_id = $_SESSION['id']; // Mengambil ID pengguna dari sesi
            // Kueri untuk mendapatkan menu utama yang dapat diakses oleh pengguna ini
            $main_menus_query = "SELECT DISTINCT m.id, m.menu_name, m.icon_class
                                 FROM tb_menus m
                                 JOIN tb_user_menu_access uma ON m.id = uma.menu_id
                                 WHERE uma.user_id = ?
                                 ORDER BY m.order_display ASC";
            $stmt_main = $koneksi->prepare($main_menus_query);
            $stmt_main->bind_param("i", $current_user_id);
            $stmt_main->execute();
            $main_menus = $stmt_main->get_result();
            while ($main_menu = $main_menus->fetch_assoc()) {
                $nav_item_class = 'nav-item';
                $nav_link_class = 'nav-link'; // Default class untuk nav-link
                // Cek apakah ada submenu untuk menu utama ini yang diakses pengguna
                $has_submenu_query = "SELECT COUNT(sm.id) AS total_submenus
                                      FROM tb_submenus sm
                                      JOIN tb_user_menu_access uma ON sm.id = uma.submenu_id
                                      WHERE sm.menu_id = ? AND uma.user_id = ?";
                $stmt_count_sub = $koneksi->prepare($has_submenu_query);
                $stmt_count_sub->bind_param("ii", $main_menu['id'], $current_user_id);
                $stmt_count_sub->execute();
                $result_count_sub = $stmt_count_sub->get_result()->fetch_assoc();
                $has_submenus = ($result_count_sub['total_submenus'] > 0);
                $stmt_count_sub->close();
                // Jika ada submenu, cek apakah salah satu submenunya aktif
                    $check_submenu_active_query = "SELECT sm.page_link
                                                   FROM tb_submenus sm
                                                   JOIN tb_user_menu_access uma ON sm.id = uma.submenu_id
                                                   WHERE sm.menu_id = ? AND uma.user_id = ? AND sm.page_link = ?";
                    $stmt_check_sub_active = $koneksi->prepare($check_submenu_active_query);
                    $stmt_check_sub_active->bind_param("iis", $main_menu['id'], $current_user_id, $_GET['page']);
                    $stmt_check_sub_active->execute();
                    if ($stmt_check_sub_active->get_result()->num_rows > 0) {
                        $nav_item_class .= ' menu-open'; // Buka menu utama
                        $nav_link_class .= ' active';   // Aktifkan link menu utama
                    }
                    $stmt_check_sub_active->close();
                echo '<li class="' . $nav_item_class . '">';
                // Tautkan menu utama ke # jika ada submenu, atau ke page_link jika dia sendiri adalah halaman.
                // Karena tb_menus tidak punya page_link, kita gunakan '#' atau tentukan target default jika tidak ada submenu.
                $main_menu_link = '#'; 
                // Jika Anda ingin menu utama yang tidak memiliki submenu untuk mengarah ke suatu halaman,
                // Anda perlu menambahkan kolom 'page_link' di tb_menus
                
                echo '<a href="' . $main_menu_link . '" class="' . $nav_link_class . '">';
                echo '<i class="nav-icon ' . htmlspecialchars($main_menu['icon_class']) . '"></i>';
                echo '<p>' . htmlspecialchars($main_menu['menu_name']);
                if ($has_submenus) {
                    echo '<i class="right fas fa-angle-left"></i>';
                }
                echo '</p>';
                echo '</a>';
                if ($has_submenus) {
                    echo '<ul class="nav nav-treeview">';
                    $submenus_query = "SELECT sm.submenu_name, sm.page_link
                                       FROM tb_submenus sm
                                       JOIN tb_user_menu_access uma ON sm.id = uma.submenu_id
                                       WHERE sm.menu_id = ? AND uma.user_id = ?
                                       ORDER BY sm.order_display ASC";
                    $stmt_sub = $koneksi->prepare($submenus_query);
                    $stmt_sub->bind_param("ii", $main_menu['id'], $current_user_id);
                    $stmt_sub->execute();
                    $submenus = $stmt_sub->get_result();
                    while ($submenu = $submenus->fetch_assoc()) {
                        $submenu_active_class = '';
                        if (isset($_GET['page']) && isset($submenu['page_link']) && $_GET['page'] == $submenu['page_link']) {
                            $submenu_active_class = ' active';
                        }
                        echo '<li class="nav-item">';
                        echo '<a href="index.php?page=' . htmlspecialchars($submenu['page_link']) . '" class="nav-link' . $submenu_active_class . '">';
                        echo '<i class="far fa-circle nav-icon"></i>';
                        echo '<p>' . htmlspecialchars($submenu['submenu_name']) . '</p>';
                        echo '</a>';
                        echo '</li>';
                    }
                    $stmt_sub->close();
                    echo '</ul>'; // Tutup ul nav-treeview
                }
                echo '</li>'; // Tutup li nav-item untuk menu utama
            }
            $stmt_main->close();
            ?>
			<li class="nav-item">
                <a href="index.php?page=edit-password" class="nav-link">
                    <i class="nav-icon fas fa-lock"></i>
                    <p>Change Password</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
</div>