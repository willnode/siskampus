<!DOCTYPE html>
<html lang="id">

<head>
  <?= view('head') ?>
</head>

<body>
  <div class="wrapper">

    <?= view('navbar') ?>

    <div class="container my-5" style="max-width: 540px;">
      <div class="card">
        <div class="card-body">
          <form enctype="multipart/form-data" method="post">
            <div class="d-flex mb-3">
              <h1 class="h3 mb-0 mr-auto">Edit Data Bimbingan</h1>
              <a href="/user/info/" class="btn btn-outline-secondary ml-2">Kembali</a>
            </div>
            <div class="mb-3">
              <p>
                NIM: <b><?= esc($item->nim) ?></b><br>
                Nama: <b><?= esc($item->nama) ?></b><br>
              </p>
            </div>
            <label class="d-block mb-3">
              <span>Judul yang dibimbing</span>
              <input type="text" class="form-control" name="judul" value="<?= esc($item->judul) ?>">
            </label>
            <label class="d-block mb-3">
              <span>Status</span>
              <select  name="status" class="form-control" required>
                <?= implode('', array_map(function ($x) use ($item) {
                  return '<option ' . ($item->status === $x ? 'selected' : '') .
                    ' value="' . $x . '">' . ucfirst($x) . '</option>';
                }, \App\Models\PendaftarModel::$statuses)) ?>
              </select>
            </label>
            <div class="d-flex mb-3">
              <input type="submit" value="Simpan" class="btn btn-primary mr-auto">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>