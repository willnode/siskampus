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
              <h1>Data Mahasiswa</h1>
              <div class="ml-auto">
                <?= shared_view('list/button', [
                  'actions' => ['add', 'import', 'export'],
                  'target' => '',
                  'size' => 'btn-lg'
                ]); ?>
              </div>
            </div>
            <?= shared_view('list/table', [
              'data' => $data,
              'columns' => [
                'Angkatan' => function (\App\Entities\Mahasiswa $x) {
                  return $x->angkatan;
                },
                'Jumlah' => function (\App\Entities\Mahasiswa $x) {
                  return $x->jumlah;
                },
                'Action' => function (\App\Entities\Mahasiswa $x) {
                  return shared_view('list/button', [
                    'actions' => ['detail', 'export'],
                    'target' => $x->angkatan,
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