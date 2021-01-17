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
              <h1>Data Dosen</h1>
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
                'Nama' => function (\App\Entities\Dosen $x) {
                  return $x->nama;
                },
                'Departemen' => function (\App\Entities\Dosen $x) {
                  return $x->departemen;
                },
                'Action' => function (\App\Entities\Dosen $x) {
                  return view('shared/button', [
                    'actions' => ['edit'],
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