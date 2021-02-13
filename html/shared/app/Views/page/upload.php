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
    <?= view('admin/navside', [
      'page' => $page ?? ''
    ]) ?>

    <div class="content-wrapper p-4">
      <div class="container" style="max-width: 540px;">
        <div class="card">
          <div class="card-body">
            <form enctype="multipart/form-data" method="post">
              <h1 class="mb-3">Upload <?= ucfirst($page ?? 'data') ?></h1>
              <input class="form-control mb-3 h-auto" type="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
              <div class="alert alert-default-info mb-3">
                <ul class="mb-0 pl-3">
                  <li>Format file harus Excel 2007+ dan menyesuaikan tabel dalam data ekspor</li>
                  <li>Apabila ada data duplikat maka akan diupdate, selain itu akan ditambahkan</li>
                  <li>Tidak akan menghapus data lama selama tidak ada kata "delete" di kolom paling kanan</li>
                </ul>
              </div>
              <div class="d-flex">
                <input type="submit" value="Kirim" class="btn btn-primary mr-auto">
                <a href="../" class="btn btn-outline-secondary">Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>