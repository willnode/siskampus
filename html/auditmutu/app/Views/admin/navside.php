<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-olive elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="<?= static_url('logo.png') ?>" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin Center</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= \Config\Services::user()->getAvatarUrl() ?>" alt="">
      </div>
      <div class="info">
        <a href="/user/profile/" class="d-block"><?= \Config\Services::user()->name ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
          <a href="/admin/" class="nav-link <?= ($page ?? '') === 'admin' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Beranda
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/pendaftar/" class="nav-link <?= ($page ?? '') === 'pendaftar' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Data Pendaftar
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/pembimbing/" class="nav-link <?= ($page ?? '') === 'pembimbing' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-book-reader"></i>
            <p>
              Data Pembimbing
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/config/" class="nav-link <?= ($page ?? '') === 'config' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Pengaturan Web
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>