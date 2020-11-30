<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>
</head>

<body>

  <?= view('navbar') ?>

  <div class="container mb-5 mt-3">
    <div class="d-flex">
      <div class="ml-auto">
        <?= shared_view('list/button', [
          'actions' => ['add', 'view'],
          'target' => '',
          'size' => 'btn-lg'
        ]); ?>
      </div>
    </div>
    <?= ($_GET['view'] ?? '') !== 'grid' ? shared_view('list/table', [
      'data' => $list,
      'columns' => [
        'Title' => function (\App\Entities\Minute $x) {
          return $x->title;
        },
        'Room' => function (\App\Entities\Minute $x) {
          return $x->room->name;
        },
        'Time' => function (\App\Entities\Minute $x) {
          return $x->time;
        },
        'Action' => function (\App\Entities\Minute $x) {
          return shared_view('list/button', [
            'actions' => ['detail', 'edit'],
            'target' => $x->id,
            'size' => 'btn-sm'
          ]);
        },
      ]
    ]) : shared_view('list/grid', [
      'data' => $list,
      'render' =>  function (\App\Entities\Minute $x) {
    ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= $x->title ?></h5>
          <h6 class="card-subtitle text-muted mb-2"><?= $x->room->name.', '.$x->time->humanize() ?></h6>
          <div>
            <?= shared_view('list/button', [
            'actions' => ['detail', 'edit'],
            'target' => $x->id,
            'size' => 'btn-sm'
          ]); ?>
          </div>
        </div>
      </div>
    <?php
      }
    ]) ?>
    <?= shared_view('list/pagination') ?>
  </div>
</body>