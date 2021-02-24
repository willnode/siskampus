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
                <h1 class="h3 mb-0 mr-auto">Edit Pendaftar</h1>
                <a href="/admin/pendaftar/" class="btn btn-outline-secondary ml-2">Kembali</a>
              </div>
              <label class="d-block mb-3">
                <span>ID</span>
                <input type="text" class="form-control" name="nim" value="<?= esc($item->nim) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Nama</span>
                <input type="text" class="form-control" name="name" value="<?= esc($item->nama) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Program Studi</span>
                <input type="text" class="form-control" name="prodi" value="<?= esc($item->prodi) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>HP</span>
                <input type="text" class="form-control" name="hp" value="<?= esc($item->hp) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Status</span>
                <select name="status" class="form-control" required>
                  <?= implode('', array_map(function ($x) use ($item) {
                    return '<option ' . ($item->status === $x ? 'selected' : '') .
                      ' value="' . $x . '">' . ucfirst($x) . '</option>';
                  }, \App\Models\PendaftarModel::$statuses)) ?>
                </select>
              </label>
              <label class="d-block mb-3">
                <span>Pembimbing</span>
                <input type="text" class="form-control" name="pembimbing" value="<?= esc($item->pembimbing) ?>" required>
              </label>
              <div class="d-flex mb-3">
                <input type="submit" value="Simpan" class="btn btn-primary mr-auto">
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