<?php
$selected_user_id = null;
if (isset($_GET['user_id'])) {
    $selected_user_id = (int)$_GET['user_id'];
}

// Tangani pengiriman form (saat tombol simpan ditekan)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_access'])) {
    $user_id_to_update = (int)$_POST['user_id'];
    $selected_menus = isset($_POST['menu_access']) ? $_POST['menu_access'] : []; // Array of menu_id
    $selected_submenus = isset($_POST['submenu_access']) ? $_POST['submenu_access'] : []; // Array of submenu_id

    // 1. Hapus semua entri akses menu yang ada untuk pengguna ini
    $delete_query = "DELETE FROM tb_user_menu_access WHERE user_id = ?";
    $stmt_delete = $koneksi->prepare($delete_query);
    $stmt_delete->bind_param("i", $user_id_to_update);
    $stmt_delete->execute();
    $stmt_delete->close();

    // 2. Sisipkan kembali akses menu yang baru dipilih
    $insert_query = "INSERT INTO tb_user_menu_access (user_id, menu_id, submenu_id) VALUES (?, ?, ?)";
    $stmt_insert = $koneksi->prepare($insert_query);

    // Masukkan akses untuk menu utama (jika menu utama dicentang tanpa melihat submenunya)
    // Penting: Pastikan entri ini ada jika submenu di bawahnya dicentang, untuk memastikan menu utama muncul
    foreach ($selected_menus as $menu_id) {
        $null_submenu_id = NULL; // Untuk menu utama, submenu_id adalah NULL
        $stmt_insert->bind_param("iii", $user_id_to_update, $menu_id, $null_submenu_id);
        $stmt_insert->execute();
    }

    // Masukkan akses untuk submenu
    foreach ($selected_submenus as $submenu_id) {
        // Dapatkan menu_id dari submenu ini
        $get_menu_id_query = "SELECT menu_id FROM tb_submenus WHERE id = ?";
        $stmt_get_menu_id = $koneksi->prepare($get_menu_id_query);
        $stmt_get_menu_id->bind_param("i", $submenu_id);
        $stmt_get_menu_id->execute();
        $result_menu_id = $stmt_get_menu_id->get_result()->fetch_assoc();
        $menu_id_for_submenu = $result_menu_id['menu_id'];
        $stmt_get_menu_id->close();

        // Pastikan menu utama dari submenu ini juga ikut diinsert jika belum ada
        // Ini penting agar menu utama muncul di sidebar ketika hanya submenunya yang diakses.
        $check_parent_menu_query = "SELECT COUNT(*) FROM tb_user_menu_access WHERE user_id = ? AND menu_id = ? AND submenu_id IS NULL";
        $stmt_check_parent = $koneksi->prepare($check_parent_menu_query);
        $stmt_check_parent->bind_param("ii", $user_id_to_update, $menu_id_for_submenu);
        $stmt_check_parent->execute();
        $parent_exists = $stmt_check_parent->get_result()->fetch_row()[0];
        $stmt_check_parent->close();

        if ($parent_exists == 0) {
            $null_submenu_id = NULL;
            $stmt_insert->bind_param("iii", $user_id_to_update, $menu_id_for_submenu, $null_submenu_id);
            $stmt_insert->execute();
        }

        // Insert submenu access
        $stmt_insert->bind_param("iii", $user_id_to_update, $menu_id_for_submenu, $submenu_id);
        $stmt_insert->execute();
    }
    $stmt_insert->close();

    echo '<div class="alert alert-success">Akses menu berhasil diperbarui!</div>';
    
    // Refresh halaman untuk menampilkan perubahan
    $selected_user_id = $user_id_to_update; // Set kembali user_id yang dipilih
}
// ... (Kode PHP di bagian atas file Anda tetap sama)

// Ambil daftar semua pengguna
$users_query = "SELECT Id, Nama,Username FROM tb_user ORDER BY Nama ASC";
$users_result = $koneksi->query($users_query);

// Ambil semua menu dan submenu
$all_menus_query = "SELECT id, menu_name, icon_class FROM tb_menus ORDER BY order_display ASC";
$all_menus_result = $koneksi->query($all_menus_query);

// Ambil akses menu yang sudah ada untuk pengguna yang dipilih
$user_access_data = [
    'menu' => [],
    'submenu' => []
];
if ($selected_user_id) {
    $access_query = "SELECT menu_id, submenu_id FROM tb_user_menu_access WHERE user_id = ?";
    $stmt_access = $koneksi->prepare($access_query);
    $stmt_access->bind_param("i", $selected_user_id);
    $stmt_access->execute();
    $access_result = $stmt_access->get_result();
    while ($row = $access_result->fetch_assoc()) {
        if ($row['menu_id'] !== null && $row['submenu_id'] === null) {
            $user_access_data['menu'][$row['menu_id']] = true;
        } elseif ($row['submenu_id'] !== null) {
            $user_access_data['submenu'][$row['submenu_id']] = true;
        }
    }
    $stmt_access->close();
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Pengaturan Akses Menu</h1>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Pilih Pengguna dan Atur Akses</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="index.php">
                            <input type="hidden" name="page" value="pengaturan-akses-menu">
                            <div class="form-group">
                                <label for="user_select">Pilih Pengguna:</label>
                                <select class="form-control" id="user_select" name="user_id" onchange="this.form.submit()">
                                    <option value="">-- Pilih Pengguna --</option>
                                    <?php while ($user = $users_result->fetch_assoc()): ?>
                                        <option value="<?php echo $user['Id']; ?>" <?php echo ($selected_user_id == $user['Id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($user['Username']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </form>

                        <?php if ($selected_user_id): ?>
                        <form method="POST" action="">
                            <input type="hidden" name="user_id" value="<?php echo $selected_user_id; ?>">
                            <h4>Atur Akses:</h4>
                            <?php while ($main_menu = $all_menus_result->fetch_assoc()): ?>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input main-menu-checkbox" id="menu_<?php echo $main_menu['id']; ?>"
                                               name="menu_access[]" value="<?php echo $main_menu['id']; ?>"
                                               <?php echo isset($user_access_data['menu'][$main_menu['id']]) ? 'checked' : ''; ?>
                                               data-menu-id="<?php echo $main_menu['id']; ?>"> <label class="form-check-label font-weight-bold" for="menu_<?php echo $main_menu['id']; ?>">
                                            <i class="<?php echo htmlspecialchars($main_menu['icon_class']); ?> mr-1"></i>
                                            <?php echo htmlspecialchars($main_menu['menu_name']); ?>
                                        </label>
                                    </div>
                                    <div class="ml-4 submenu-container-<?php echo $main_menu['id']; ?>"> <?php
                                        $submenus_for_menu_query = "SELECT id, submenu_name, page_link FROM tb_submenus WHERE menu_id = ? ORDER BY order_display ASC";
                                        $stmt_sub_all = $koneksi->prepare($submenus_for_menu_query);
                                        $stmt_sub_all->bind_param("i", $main_menu['id']);
                                        $stmt_sub_all->execute();
                                        $submenus_for_menu_result = $stmt_sub_all->get_result();

                                        while ($submenu = $submenus_for_menu_result->fetch_assoc()):
                                        ?>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input submenu-checkbox submenu-of-<?php echo $main_menu['id']; ?>" id="submenu_<?php echo $submenu['id']; ?>"
                                                       name="submenu_access[]" value="<?php echo $submenu['id']; ?>"
                                                       <?php echo isset($user_access_data['submenu'][$submenu['id']]) ? 'checked' : ''; ?>> <label class="form-check-label" for="submenu_<?php echo $submenu['id']; ?>">
                                                    <?php echo htmlspecialchars($submenu['submenu_name']); ?> (<?php echo htmlspecialchars($submenu['page_link']); ?>)
                                                </label>
                                            </div>
                                        <?php endwhile;
                                        $stmt_sub_all->close();
                                        ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>

                            <button type="submit" name="save_access" class="btn btn-primary mt-4">Simpan Akses</button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="plugins/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Event listener untuk checkbox menu utama
    $('.main-menu-checkbox').on('change', function() {
        var mainMenuId = $(this).data('menu-id');
        var isChecked = $(this).is(':checked');

        // Cari semua submenu yang merupakan anak dari menu utama ini dan ubah status centangnya
        $('.submenu-of-' + mainMenuId).prop('checked', isChecked);
    });

    // Event listener untuk checkbox submenu
    // Jika ada submenu yang dicentang, pastikan induknya juga dicentang
    $('.submenu-checkbox').on('change', function() {
        var parentMenuIdMatch = $(this).closest('[class^="submenu-container-"]').attr('class').match(/submenu-container-(\d+)/);
        if (!parentMenuIdMatch || parentMenuIdMatch.length < 2) {
            console.error('Parent menu ID not found for submenu:', this);
            return;
        }
        var parentMenuId = parentMenuIdMatch[1];

        var totalSubmenus = $('.submenu-of-' + parentMenuId).length;
        var checkedSubmenus = $('.submenu-of-' + parentMenuId + ':checked').length;

        // Dapatkan checkbox menu utama yang relevan
        var mainMenuCheckbox = $('.main-menu-checkbox[data-menu-id="' + parentMenuId + '"]');

        if (checkedSubmenus > 0) {
            // Jika setidaknya satu submenu dicentang, induknya harus dicentang
            mainMenuCheckbox.prop('checked', true);
        } else if (checkedSubmenus === 0 && totalSubmenus > 0) {
            // Jika tidak ada submenu yang dicentang, dan ada submenunya, induknya tidak dicentang
            mainMenuCheckbox.prop('checked', false);
        }
        // Jika tidak ada submenu (totalSubmenus === 0), status induk tidak diubah oleh submenu.
        // Status induk (menu utama) untuk menu tanpa submenu akan diatur secara manual oleh admin.
    });

    // Inisialisasi: Saat halaman dimuat, sesuaikan status checkbox menu utama
    // berdasarkan status submenu yang sudah ada
    $('.main-menu-checkbox').each(function() {
        var mainMenuId = $(this).data('menu-id');
        var totalSubmenus = $('.submenu-of-' + mainMenuId).length;
        var checkedSubmenus = $('.submenu-of-' + mainMenuId + ':checked').length;

        if (totalSubmenus > 0) {
            // Jika ada submenu, dan setidaknya satu submenu dicentang, induknya harus dicentang
            if (checkedSubmenus > 0) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        }
        // Jika tidak ada submenu, biarkan status induk apa adanya (ditetapkan dari DB atau default)
    });
});
</script>