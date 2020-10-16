<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?= module_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= module_url('datatables.net-dt/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
  <script src="<?= module_url('jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= module_url('datatables.net/js/jquery.dataTables.min.js') ?>"></script>
</head>

<body>

  <?= view('navbar') ?>

  <div class="container my-5">
    <div class="row">
      <?php /** @var \App\Entities\Proposal[] $list */ ?>
      <?php foreach ($list as $item) : ?>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <a href="/proposal/<?= $item->id ?>" class="float-right btn btn-warning">
                <img src="<?= module_url('bootstrap-icons/icons/pencil-square.svg') ?>" />
              </a>
              <div class="card-head">
                <h3 class="mb-3"><?= esc($item->title) ?></h3>
              </div>
              <p><b>Status</b>: <span class="badge bg-primary"><?= $item->status ?></span></p>
              <p><b>RMK</b>: <?= $item->expertise->name ?></p>
              <p><b>Abstrak</b>:</p>
              <p><?= esc($item->abstract) ?></p>
              <?php foreach ($item->lecturer as $i => $l) : ?>
                <p><b>Pembimbing <?= $i + 1 ?></b>: <?= esc($l->name) ?></p>
              <?php endforeach ?>
            </div>
          </div>
        </div>
      <?php endforeach ?>
      <div class="col-md-6 col-lg-4">
        <a href="/proposal/new" class="btn btn-success p-5 h-100 w-100 d-flex flex-column align-items-center justify-content-center">
          <img src="<?= module_url('bootstrap-icons/icons/plus-circle-fill.svg') ?>" style="filter: contrast(0) brightness(2);" width="50px" />
          <div class="my-3">Tambah Baru</div>
        </a>
      </div>
    </div>
  </div>
</body>