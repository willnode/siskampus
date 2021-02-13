<?php

/** @var Shared\Entities\Operator $user */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?= view('head') ?>
</head>

<body>
  <div class="wrapper">

    <div class="main-header">
      <?= view('navbar') ?>
    </div>
    <?= view('admin/navside') ?>

    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <?= shared_view('list/rows') ?>
            <?php /** @var \App\Entities\User[] $data */ ?>
            <div class="d-flex">
              <h1>Data Pendaftar <?= empty($_GET['archived']) ? '' : '(Arsip)' ?></h1>
              <div class="ml-auto">
                <?= shared_view('list/button', [
                  'actions' => ['import', 'export', 'archived'],
                  'target' => '',
                  'size' => 'btn-lg'
                ]); ?>
              </div>
            </div>
            <?php if ($pembimbing) : ?>
              <h4>
                <a href="/admin/pembimbing/" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
                Dosen: <?= $pembimbing->nama ?> (<?= $pembimbing->nid ?>)
              </h4>
            <?php endif ?>
            <?= shared_view('list/table', [
              'data' => $data,
              'columns' => [
                'Nama' => function (\App\Entities\Pendaftar $x) {
                  return $x->nama;
                },
                'Status' => function (\App\Entities\Pendaftar $x) {
                  return '<h5>' . \App\Models\PendaftarModel::$statusesInHtml[$x->status] . '</h5>';
                },
                'Action' => function (\App\Entities\Pendaftar $x) {
                  return shared_view('list/button', [
                    'actions' => ['detail', 'edit'],
                    'target' => $x->id,
                    'size' => 'btn-sm'
                  ]);
                }
              ]
            ]) ?>
            <?= shared_view('list/pagination') ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>