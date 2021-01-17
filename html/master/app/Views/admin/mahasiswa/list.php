<?php

/** @var Shared\Entities\Operator $user */ ?>
<!doctype html>
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
                  'actions' => ['import', 'export'],
                  'target' => '',
                  'size' => 'btn-lg'
                ]); ?>
              </div>
            </div>
            <?= shared_view('list/table', [
              'data' => $data,
              'columns' => [
                'Angkatan' => function (\App\Entities\Mahasiswa $x) {
                  return $x->kelasFull;
                },
                'Jumlah' => function (\App\Entities\Mahasiswa $x) {
                  return $x->jumlah;
                },
                'Action' => function (\App\Entities\Mahasiswa $x) {
                  return view('shared/button', [
                    'actions' => ['detail', 'export'],
                    'target' => $x->thn_masuk . ',' . $x->kelas,
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