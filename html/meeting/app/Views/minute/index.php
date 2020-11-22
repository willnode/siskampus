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
            'actions' => ['add'],
            'target' => '',
            'size' => 'btn-lg'
          ]); ?>
      </div>
    </div>
    <?= shared_view('list/table', [
      'data' => $list,
      'columns' => [
        'Chairman' => function (\App\Entities\Minute $x) {
          return $x->chairman->name;
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
    ]); ?>
    <?= shared_view('list/pagination') ?>
  </div>
</body>