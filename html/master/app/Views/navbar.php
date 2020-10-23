<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><?= \Config\Services::site()->shared->short_name ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/go/research">Penelitian</a>
        </li>
      </ul>
      <form class="d-flex">
        <a class="mr-auto btn btn-link" href="/profile">Profile</a>
        <a class="btn btn-outline-success" href="/logout">Logout</a>
      </form>
    </div>
  </div>
</nav>

<div class="container">
<?php if ($msg = \Config\Services::session()->get('message')) : ?>
  <div class="alert alert-info alert-dismissable m-2" role="alert">
    <?= esc($msg) ?>
    <button type="button" class="btn-close float-right" data-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif ?>
<?php if ($msg = \Config\Services::session()->get('error')) : ?>
  <div class="alert alert-danger alert-dismissable m-2">
    <?= esc($msg) ?>
  </div>
<?php endif ?>
</div>
