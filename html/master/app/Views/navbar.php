<nav class="navbar navbar-expand-md <?= \Config\Services::site()->shared->navbar_theme ?>">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="<?= static_url('logo.png') ?>">
      <span><?= \Config\Services::site()->shared->short_name ?></span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <hr class="d-md-none">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link <?= ($page ?? '') === 'index' ? 'active' : '' ?>" href="/"><i class="fa fa-home"></i> Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page ?? '') === 'profile' ? 'active' : '' ?>" href="/profile">Edit Profil</a>
        </li>
        <li class="d-none d-md-block border-right mx-2"></li>
        <li class="nav-item ">
          <a class="nav-link" href="/go/research">Penelitian</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/go/meeting">Rapat</a>
        </li>
        <li class="nav-divider"></li>
      </ul>
      <hr class="d-md-none">
      <?= shared_view('navbar/dropdown') ?>
    </div>
  </div>
</nav>

<?= shared_view('navbar/alerts') ?>