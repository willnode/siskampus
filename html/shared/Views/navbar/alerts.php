
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