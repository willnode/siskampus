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
            NIM: <b><?= esc($profile->nim) ?></b><br>
            HP/WA: <b><?= esc($profile->hp) ?></b><br>
            Status: <b class="h5"><?= \App\Models\PendaftarModel::$statusesInHtml[$profile->status] ?? '?' ?></b><br>
            Judul Diterima: <b><?= esc($profile->judul) ?: '<i>Belum ditentukan</i>' ?></b><br>
          </p>
          <?php if ($profile->status === 'pengerjaan') : $bio = (new \App\Models\PembimbingModel)->atNid($profile->pembimbing) ?>
            <p>
              Berikut kontak untuk menghubungi pembimbing,<br>silahkan digunakan untuk komunikasi sebijaknya:
            </p>
            <p>
              Nama: <b><?= esc($bio->nama) ?></b></br>
              HP/WA: <b><?= esc($bio->hp) ?></b></br>
              Email: <b><?= esc($bio->email) ?></b></br>
            </p>
          <?php endif ?>
        <?php else : ?>
          <p>Anda belum mendaftar sebagai mahasiswa tugas akhir</p>
          <p>Jika anda ingin mendaftar, silahkan ikuti link berikut:</p>
          <p><a href="/user/info/edit" class="btn btn-primary">Buka Form Pendaftaran</a></p>
        <?php endif ?>
      </div>
    </div>
  </div>
</body>

</html>