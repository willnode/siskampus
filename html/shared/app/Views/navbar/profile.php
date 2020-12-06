<ul class="ml-auto navbar-nav mx-2">
  <li class="nav-item" id="navbar-profile">
      <div>
        <span class="text-white text-nowrap"><?= \Config\Services::user()->name ?></span><br>
        <span class="text-white-50"><?= \Config\Services::user()->id ?></span>
      </div>
      <?php if ($avatar = \Config\Services::user()->avatar) : ?>
        <img src="<?= get_file('master/avatar', $avatar) ?>" alt="">
      <?php else : ?>
        <i class="fa fa-user fa-2x d-block mx-3"></i>
      <?php endif ?>
  </li>
</ul>