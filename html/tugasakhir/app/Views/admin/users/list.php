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
              <h1>Data User</h1>
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
                'Name' => function (\Shared\Entities\User $x) {
                  return $x->name;
                },
                'Username' => function (\Shared\Entities\User $x) {
                  return $x->username;
                },
                'Role' => function (\Shared\Entities\User $x) {
                  return ucfirst($x->role);
                },
                'Action' => function (\Shared\Entities\User $x) {
                  return shared_view('list/button', [
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