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
              <h1>Data Pembimbing</h1>
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
                'NIDN' => function (\App\Entities\Pembimbing $x) {
                  return $x->nid;
                },
                'Nama' => function (\App\Entities\Pembimbing $x) {
                  return $x->nama;
                },
                'Departemen' => function (\App\Entities\Pembimbing $x) {
                  return $x->departemen;
                },
                'Action' => function (\App\Entities\Pembimbing $x) {
                  return shared_view('list/button', [
                    'actions' => ['edit', 'detail'],
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