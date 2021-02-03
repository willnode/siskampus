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
              <h1 class="h3 mb-0 mr-auto">Edit Data Pembimbing</h1>
              <a href="/user/info/" class="btn btn-outline-secondary ml-2">Kembali</a>
            </div>
            <div class="mb-3">
              <p>
                Nama: <b><?= esc($user->name) ?></b><br>
                NIDN/Username: <b><?= esc($user->username) ?></b>
              </p>
            </div>
            <label class="d-block mb-3">
              <span>Email Publik</span>
              <input type="text" class="form-control" name="email" value="<?= esc($profile->email) ?>">
            </label>
            <label class="d-block mb-3">
              <span>HP/WA Publik</span>
              <input type="text" class="form-control" name="hp" value="<?= esc($profile->hp) ?>">
            </label>
            <p><i>Data Kontak anda hanya akan dibagikan pada mahasiswa bimbingan anda apabila anda sendiri sudah menyetujuinya.</i></p>
            <label class="d-block mb-3">
              <span>Tema Tugas Akhir yang ingin dibimbing</span>
              <select id="tema" name="tema" class="form-control" required>
                <option value="">-- Pilih Tema --</option>
                <?= implode('', array_map(function ($x) use ($profile) {
                  return '<option ' . ($profile->tema === $x ? 'selected' : '') .
                    ' value="' . $x . '">' . ucfirst($x) . '</option>';
                },  \App\Models\ConfigModel::get()->categories)) ?>
              </select>
            </label>
            <label class="d-block mb-3">
              <span>Deskripsi Tema yang akan dibimbing</span>
              <textarea id="deskripsi" name="deskripsi" class="form-control" required><?= esc($profile->deskripsi) ?> </textarea>
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