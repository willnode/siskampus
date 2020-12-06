<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>

</head>

<body>

  <?= view('navbar') ?>

  <div class="container my-3" style="max-width: 768px;">
    <?php /** @var \App\Entities\Minute $item */ ?>
    <div class="d-flex d-print-none">
      <a href="/minute/" class="btn btn-secondary mr-auto"><i class="fa fa-arrow-left"></i></a>
      <a href="/minute/edit/<?= $item->id ?>" class="btn btn-warning mr-2"><i class="fa fa-edit"></i></a>
      <button onclick="print()" class="btn btn-primary"><i class="fa fa-print"></i></button>
    </div>
    <div>
      <h1 class="text-center"><?= esc($item->title) ?></h1>
      <h3 class="text-center"><?= esc(\Config\Services::site()->shared->long_name) ?></h3>
      <table class="mx-auto mt-5">
        <tbody>
          <tr>
            <td width="100">Hari</td>
            <td width="15">:</td>
            <td><?= $item->time->toLocalizedString('l') ?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><?= $item->time->toLocalizedString('YYYY-mm-dd') ?></td>
          </tr>
          <tr>
            <td>Waktu</td>
            <td>:</td>
            <td><?= $item->time->toLocalizedString('HH:mm') ?></td>
          </tr>
          <tr>
            <td>Tempat</td>
            <td>:</td>
            <td><?= $item->room->name ?></td>
          </tr>
        </tbody>
      </table>
      <div class="note my-5">
        <?= $item->note ?>
      </div>
      <p>Peserta Rapat:</p>
      <table class="table table-bordered mb-5">
        <thead>
          <tr>
            <th width="50">No</th>
            <th>Nama</th>
            <th width="150">Tanda Tangan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($item->participants as $k => $part) : ?>
            <tr>
              <td>
                <?= $k + 1 ?>
              </td>
              <td>
                <?= $part->name ?>
              </td>
              <td></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <div class="row text-center">
        <div class="col">
          <p>Pimpinan Rapat</p>
          <p style="height: 60px;"></p>
          <p><?= $item->chairman->name ?></p>
        </div>
        <div class="col">
          <p>Notulis</p>
          <p style="height: 60px;"></p>
          <p><?= $item->reporter->name ?></p>
        </div>
      </div>
    </div>
  </div>
</body>