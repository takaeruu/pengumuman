<?php $currentUri = uri_string(); ?>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <img src="<?= base_url('images/' . $yogi->logo_website) ?>" alt="logo" style="max-width: 150%; height: auto; max-height: 100px;"/>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu">
                <ul class="menu">
    <li class="sidebar-title">Menu</li>

    <!-- Dashboard -->
    <li class="sidebar-item <?= ($currentUri == 'home/dashboard') ? 'active' : '' ?>">
        <a href="<?= base_url('home/dashboard') ?>" class='sidebar-link'>
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
    </li>

    

    <!-- Pengumuman -->
    <li class="sidebar-item has-sub <?= (in_array($currentUri, ['home/pengumuman', 'home/pengumuman_terpilih'])) ? 'active' : '' ?>">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-megaphone-fill"></i>
            <span>Pengumuman</span>
        </a>
        <?php
      if (session()->get('level') == 'admin' || session()->get('level') == 'kepsek' || session()->get('level') == 'wakepsek'){
        ?>
        <ul class="submenu">
            <li class="submenu-item <?= ($currentUri == 'home/pengumuman') ? 'active' : '' ?>">
                <a href="<?= base_url('home/pengumuman') ?>">Pengumuman Umum</a>
            </li>
            <?php 
      } else {

      }
?>
            <li class="submenu-item <?= ($currentUri == 'home/pengumuman_terpilih') ? 'active' : '' ?>">
                <a href="<?= base_url('home/pengumuman_terpilih') ?>">Pengumuman Terpilih</a>
            </li>
        </ul>
    </li>

    <?php
      if (session()->get('level') == 'admin' || session()->get('level') == 'kepsek' || session()->get('level') == 'wakepsek'){
        ?>
    <!-- Jurusan -->
    <li class="sidebar-item <?= ($currentUri == 'home/jurusan') ? 'active' : '' ?>">
        <a href="<?= base_url('home/jurusan') ?>" class='sidebar-link'>
            <i class="fa fa-chalkboard-teacher"></i>
            <span>Jurusan</span>
        </a>
    </li>

    <?php 
      } else {

      }
?>


    <!-- Kelas -->
    <li class="sidebar-item <?= ($currentUri == 'home/kelas') ? 'active' : '' ?>">
        <a href="<?= base_url('home/kelas') ?>" class='sidebar-link'>
            <i class="fa fa-school"></i>
            <span>Kelas</span>
        </a>
    </li>

    <!-- Siswa -->
    <li class="sidebar-item <?= ($currentUri == 'home/siswa') ? 'active' : '' ?>">
        <a href="<?= base_url('home/siswa') ?>" class='sidebar-link'>
            <i class="fa fa-user-graduate"></i>
            <span>Siswa</span>
        </a>
    </li>

    <?php
      if (session()->get('level') == 'admin'){
        ?>
    <!-- User -->
    <li class="sidebar-item <?= ($currentUri == 'home/user') ? 'active' : '' ?>">
        <a href="<?= base_url('home/user') ?>" class='sidebar-link'>
            <i class="fa fa-users"></i>
            <span>User</span>
        </a>
    </li>

    <?php 
      } else {

      }
?>

<?php
      if (session()->get('level') == 'admin'){
        ?>
    <!-- Settings -->
    <!-- Settings Dropdown -->
<li class="sidebar-item has-sub <?= (in_array($currentUri, ['home/setting', 'home/soft_delete', 'home/restore_edit_user', 'home/log_activity'])) ? 'active' : '' ?>">
    <a href="#" class='sidebar-link'>
        <i class="bi bi-gear-fill"></i>
        <span>Settings</span>
    </a>
    <ul class="submenu">
        <!-- Settings -->
        <li class="submenu-item <?= ($currentUri == 'home/setting') ? 'active' : '' ?>">
            <a href="<?= base_url('home/setting') ?>">Settings</a>
        </li>

        <!-- Recycle Bin -->
        <li class="submenu-item <?= ($currentUri == 'home/soft_delete') ? 'active' : '' ?>">
            <a href="<?= base_url('home/soft_delete') ?>">Recycle Bin</a>
        </li>

        <!-- Restore Edit -->
        <li class="submenu-item <?= ($currentUri == 'home/restore_edit_user') ? 'active' : '' ?>">
            <a href="<?= base_url('home/restore_edit_user') ?>">Restore Edit</a>
        </li>

        <!-- Log Activity -->
        <li class="submenu-item <?= ($currentUri == 'home/log_activity') ? 'active' : '' ?>">
            <a href="<?= base_url('home/log_activity') ?>">Log Activity</a>
        </li>
    </ul>
</li>
<?php 
      } else {

      }
?>

</ul>

                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3"></header>
