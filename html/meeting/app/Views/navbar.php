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
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= ($page ?? '') === 'index' ? 'active' : '' ?>" href="/">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page ?? '') === 'minute' ? 'active' : '' ?>" href="/minute/">Laporan</a>
        </li>
      </ul>
      <hr class="d-md-none">
      <?= shared_view('navbar/dropdown') ?>
    </div>
  </div>
</nav>

<?= shared_view('navbar/alerts') ?>
