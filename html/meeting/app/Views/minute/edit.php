<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>

</head>

<body>

  <?= view('navbar') ?>

  <div class="container-fluid my-5">
    <?php /** @var \App\Entities\Minute $item */ ?>
    <form class="row" method="POST" enctype='multipart/form-data'>
      <div class="col-md-6 col-lg-4 mb-3">
        <div class="card" id="form" data-department="<?= esc($user->program->department_id ?? $item->student->program->department_id) ?>">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Judul</label>
              <input class="form-control" name="title" value="<?= esc($item->title) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Pemimpin</label>
              <select class="form-select">
              </select>
            </div>
            <div class="mb-3 d-flex">
              <input type="submit" class="btn btn-primary" value="Submit">
              <a href="/proposal" class="ml-auto btn btn-outline-secondary">Batalkan</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-8 mb-3">
        <div class="card">
          <div class="card-body">
          </div>
        </div>
      </div>
    </form>

  </div>
  <script type="application/json">
    <?= json_encode($lecturers) ?>
  </script>
  <script>

  </script>
</body>