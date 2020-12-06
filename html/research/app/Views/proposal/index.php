<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>
</head>

<body>

  <?= view('navbar') ?>


  <div class="container mb-5 mt-3">

    <div class="d-flex">
      <h1 class="h2">Daftar Proposal</h1>
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
        'Student' => function (\App\Entities\Proposal $x) {
          return $x->student->name;
        },
        'Title' => function (\App\Entities\Proposal $x) {
          return esc(mb_strimwidth($x->title, 0, 100, "…"));
        },
        'Status' => function (\App\Entities\Proposal $x) {
          $status = ($rvs = explode('-', $x->status, 2))[0];
          return '<span class="badge bg-' . lang('Proposal.statutes-color')[($status)] . '">'
            . lang('Proposal.statutes')[$status] .
            '</span>';
        },
        'Action' => function (\App\Entities\Proposal $x) {
          return shared_view('list/button', [
            'actions' => ['detail', 'edit'],
            'target' => $x->id,
            'size' => 'btn-sm'
          ]);
        },
      ]
    ]) : shared_view('list/grid', [
      'data' => $list,
      'render' => function (\App\Entities\Proposal $item) use ($user) {
    ?>
      <?php $status = ($rvs = explode('-', $item->status, 2))[0] ?>

      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3">
            <h4 class="m-0 mr-auto">
              <span class="badge bg-<?= lang('Proposal.statutes-color')[($status)] ?>">
                <?= lang('Proposal.statutes')[$status] ?>
              </span></h4>
            <?= shared_view('list/button', [
              'actions' => ['download', 'detail', 'edit'],
              'target' => $item->id,
              'size' => 'btn-sm'
            ]) ?>
          </div>

          <p><?= $item->student->id ?> &bullet; <?= $item->student->name ?> &bullet; <?= $item->expertise->name ?></p>
          <h3 class="mb-3"><?= esc(mb_strimwidth($item->title, 0, 150, "…")) ?></h3>
          <div><b>Diperbarui: </b> <?= $item->updated_at->humanize() ?></div>
          <div><b>Pembimbing: </b></div>
          <ul>
            <?php foreach ($item->lecturer as $lecturer) : ?>
              <li>
                <?= esc($lecturer->name) ?>
                <?= array_search($lecturer->id, $rvs) ? '<span class="badge bg-success">Disetujui</span>' : '' ?>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    <?php
      }
    ]) ?>
    <?= shared_view('list/pagination') ?>
  </div>
</body>