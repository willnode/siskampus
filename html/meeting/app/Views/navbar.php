<nav class="d-print-none navbar navbar-expand-md <?= \Config\Services::site()->shared->navbar_theme ?>">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="<?= static_url('logo.png') ?>">
      <span><?= \Config\Services::site()->shared->short_name ?></span>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <hr class="d-md-none">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/logout">
            <i class="fa fa-home"></i>
            Beranda
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page ?? '') === 'minute' ? 'active' : '' ?>" href="/minute/">Laporan</a>
        </li>
      </ul>
      <hr class="d-md-none">
    </div>
    <?= shared_view('navbar/profile') ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<?= shared_view('navbar/alerts') ?>