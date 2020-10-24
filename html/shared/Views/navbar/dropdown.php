<ul class="ml-auto navbar-nav">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle p-2 p-md-0" href="#" id="navbar-profile" data-toggle="dropdown" aria-expanded="false">
      <div>
        <span class="text-white"><?= \Config\Services::user()->name ?></span><br>
        <span><?= \Config\Services::user()->id ?></span>
      </div>
      <?php if ($avatar = \Config\Services::user()->avatar) : ?>
        <img src="<?= get_file('master/avatar', $avatar) ?>" alt="">
      <?php else : ?>
        <i class="fa fa-user fa-2x d-block mx-3"></i>
      <?php endif ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-profile">
      <li><a class="dropdown-item" href="/logout">Keluar</a></li>
    </ul>
  </li>
</ul>