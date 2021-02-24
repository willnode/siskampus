<?php

/** @var Shared\Entities\Operator $user */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?= view('head') ?>
</head>

<body>

  <?= view('navbar') ?>

  <div class="container my-5" style="max-width: 720px;">
    <div class="card">
      <div class="card-body">
        <?php if ($profile) : ?>
          <div class="d-flex">
            <h1 class="mr-auto">Biodata Anda</h1>
            <div class="">
              <a href="/user/info/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
            </div>
          </div>
          <p>
            Nama: <b><?= esc($profile->nama) ?></b><br>
            Email: <b><?= esc($profile->email ?: '-') ?></b><br>
            HP/WA: <b><?= esc($profile->hp ?: '-') ?></b><br>
            Tema: <b><?= ucfirst($profile->tema) ?></b><br>
            Deskripsi Bimbingan: <br>
            <span class="white-space-break"><?= esc($profile->deskripsi) ?></span>
          </p>
          <hr>
          <h2>Daftar Bimbingan Aktif</h2>
          <?= shared_view('list/table', [
              'data' => $bimbingan,
              'columns' => [
                'Nim' => function (\App\Entities\Pendaftar $x) {
                  return esc($x->nim);
                },
                'Nama' => function (\App\Entities\Pendaftar $x) {
                  return esc($x->nama);
                },
                'Status' => function (\App\Entities\Pendaftar $x) {
                  return '<b class="h5">'.\App\Models\PendaftarModel::$statusesInHtml[$x->status] ?? '?'.'</b>';
                },
                'Action' => function (\App\Entities\Pendaftar $x) {
                  return shared_view('list/button', [
                    'actions' => ['edit'],
                    'target' => $x->id,
                    'size' => 'btn-sm'
                  ]);
                }
              ]
            ]) ?>
            <?= shared_view('list/pagination') ?>
        <?php else : ?>
          <p>Anda belum mendaftar sebagai dosen pembimbing tugas akhir.</p>
          <p>Jika anda ingin mendaftar, silahkan ikuti link berikut:</p>
          <p><a href="/user/info/edit" class="btn btn-primary">Buka Form Pendaftaran</a></p>
        <?php endif ?>
      </div>
    </div>
  </div>
</body>

</html>