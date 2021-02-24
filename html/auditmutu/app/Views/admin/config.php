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
      <div class="container" style="max-width: 540px;">
        <div class="card">
          <div class="card-body">
            <form enctype="multipart/form-data" method="post">
              <div class="d-flex mb-3">
                <h1 class="h3 mb-0 mr-auto">Edit Config</h1>
              </div>
              <label class="d-block mb-3">
                <span>Max Slot</span>
                <input type="text" class="form-control" name="max_slot" value="<?= esc($item->max_slot) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Kategori Pembimbing</span>
                <textarea class="form-control" name="categories" rows="6" required><?= esc(implode("\n", $item->categories)) ?></textarea>
              </label>
              <div class="d-flex mb-3">
                <input type="submit" value="Simpan" class="btn btn-primary mr-auto">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>