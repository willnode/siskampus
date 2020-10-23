<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>

</head>

<body>

  <?= view('navbar') ?>

  <div class="container my-3">
    <div class="row">
      <?php /** @var \App\Entities\Seminar[] $list */ ?>
      <?php if ($type !== 'operator') : ?>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">

              </div>
            </div>
          </div>
        </div>
      <?php else : ?>
      <?php endif ?>
    </div>
  </div>
</body>

</html>