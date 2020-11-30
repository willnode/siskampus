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
          'actions' => ['view'],
          'target' => '',
          'size' => 'btn-lg'
        ]); ?>
      </div>
    </div>

    <?= ($_GET['view'] ?? '') !== 'grid' ? shared_view('list/table', [
      'data' => $list,
      'columns' => [
        'Student' => function (\App\Entities\Seminar $x) {
          return $x->student->name;
        },
        'Title' => function (\App\Entities\Seminar $x) {
          return esc(mb_strimwidth($x->proposal->title, 0, 100, "…"));
        },
        'Status' => function (\App\Entities\Seminar $x) {
          return $x->status;
        },
        'Action' => function (\App\Entities\Seminar $x) {
          return shared_view('list/button', [
            'actions' => ['detail', 'edit'],
            'target' => $x->id,
            'size' => 'btn-sm'
          ]);
        },
      ]
    ]) : shared_view('list/grid', [
      'data' => $list,
      'render' => function (\App\Entities\Seminar $item) use ($user) {
    ?>
      <?php $status = ($rvs = explode('-', $item->status, 2))[0] ?>

      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3">
            <?= shared_view('list/button', [
              'actions' => ['detail', 'edit'],
              'target' => $item->id,
              'size' => 'btn-sm'
            ]) ?>
          </div>
        </div>
      </div>
    <?php
      }
    ]) ?>
    <?= shared_view('list/pagination') ?>
  </div>
</body>