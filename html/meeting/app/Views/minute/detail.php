<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>

</head>

<body>

  <?= view('navbar') ?>

  <div class="container-fluid my-3">
    <?php /** @var \App\Entities\Minute $item */ ?>
    <div class="row">
      <h1><?= $item->title ?></h1>
    </div>

  </div>
</body>