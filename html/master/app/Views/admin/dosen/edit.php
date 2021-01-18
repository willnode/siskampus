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
                <h1 class="h3 mb-0 mr-auto">Edit Dosen</h1>
                <a href="/admin/dosen/" class="btn btn-outline-secondary ml-2">Kembali</a>
              </div>
              <label class="d-block mb-3">
                <span>ID</span>
                <input type="text" class="form-control" name="name" value="<?= esc($item->id) ?>" disabled>
              </label>
              <label class="d-block mb-3">
                <span>Nama</span>
                <input type="text" class="form-control" name="name" value="<?= esc($item->nama) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Departemen</span>
                <input type="text" class="form-control" name="prodi" value="<?= esc($item->prodi) ?>" required>
              </label>
              <div class="d-flex mb-3">
                <input type="submit" value="Save" class="btn btn-primary mr-auto">
                <?php if ($item->id) : ?>
                  <label for="delete-form" class="btn btn-danger mb-0"><i class="fa fa-trash"></i></label>
                <?php endif ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form method="POST" action="/admin/mahasiswa/delete/<?= $item->id ?>">
    <input type="submit" hidden id="delete-form" onclick="return confirm('Yakin membuang data ini?')">
  </form>
</body>

</html>