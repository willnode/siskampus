<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>

</head>

<body>

  <?= view('navbar') ?>

  <div class="container-fluid my-3">
    <?php /** @var \App\Entities\Seminar $item */ ?>
    <div class="card">
      <div class="card-body">
        <div>Proposal yang akan diseminarkan</div>
        <h4><a href="/proposal/detail/<?= $item->proposal_id ?>"><?= $item->proposal->title ?></a> </h4>
        <div><?= $item->proposal->student_id ?> &bullet; <?= $item->proposal->student->name ?></div>
      </div>
    </div>
  </div>
</body>

</html>