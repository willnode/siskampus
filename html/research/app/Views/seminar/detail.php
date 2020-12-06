<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>

</head>

<body>

  <?= view('navbar') ?>

  <div class="container my-3" style="max-width: 768px;">
    <?php /** @var \App\Entities\Seminar $item */ ?>

    <div class="d-flex mb-3 d-print-none">
      <a href="/seminar/" class="btn btn-secondary mr-auto"><i class="fa fa-arrow-left"></i></a>
      <a href="/seminar/edit/<?= $item->id ?>" class="btn btn-warning mr-2"><i class="fa fa-edit"></i></a>
      <button onclick="print()" class="btn btn-primary"><i class="fa fa-print"></i></button>
    </div>

    <div class="card">
      <div class="card-body">
        <div>Proposal yang akan diseminarkan</div>
        <h4><a href="/proposal/detail/<?= $item->proposal_id ?>"><?= $item->proposal->title ?></a> </h4>
        <div><?= $item->proposal->student_id ?> &bullet; <?= $item->proposal->student->name ?></div>
        <p>Waktu: <?= $item->start_at ?></p>
      </div>
    </div>
  </div>
</body>

</html>