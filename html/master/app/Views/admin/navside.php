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
          <a href="/admin/mahasiswa/" class="nav-link <?= ($page ?? '') === 'mahasiswa' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-scroll"></i>
            <p>
              Data Mahasiswa
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/dosen/" class="nav-link <?= ($page ?? '') === 'dosen' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-scroll"></i>
            <p>
              Data Dosen
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/user/" class="nav-link <?= ($page ?? '') === 'users' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-scroll"></i>
            <p>
              Data User
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>