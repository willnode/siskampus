<nav class="navbar navbar-expand-md navbar-dark navbar-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="<?= static_url('logo.png') ?>">
      <div>
        <div>UNWAHA</div>
        <div class="text-white-50"><small>Sistem Informasi Sentral</small></div>
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link <?= ($page ?? '') === 'index' ? 'active' : '' ?>" href="/user/"><i class="fa fa-home"></i> Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page ?? '') === 'profile' ? 'active' : '' ?>" href="/user/profile">Edit Profil</a>
        </li>
        <li class="nav-divider"></li>
      </ul>
      <?= shared_view('navbar/dropdown') ?>
    </div>
  </div>
</nav>

<?= shared_view('navbar/alerts') ?>