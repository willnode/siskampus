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
              <h1 class="h3 mb-0 mr-auto">Edit User</h1>
              <a href="/user/info/" class="btn btn-outline-secondary ml-2">Kembali</a>
            </div>
            <label class="d-block mb-3">
              <span>HP/WA Aktif</span>
              <input type="text" class="form-control" name="hp" value="<?= esc($profile->hp) ?>" required>
            </label>
            <?php if (!$profile->id || $profile->status === 'ditolak') : ?>
              <label class="d-block mb-3">
                <span>Tema Tugas Akhir</span>
                <select id="tema" name="tema" class="form-control" required>
                  <option value="" selected disabled>-- Pilih Tema --</option>
                  <?= implode('', array_map(function ($x) use ($profile) {
                    return '<option ' . ($profile->tema === $x ? 'selected' : '') .
                      ' value="' . $x . '">' . ucfirst($x) . '</option>';
                  }, \App\Models\PembimbingModel::$temas)) ?>
                </select>
              </label>
              <label class="d-block mb-3">
                <span>Pilih Dosen (yang tersedia)</span>
                <select id="pembimbing" name="pembimbing" class="form-control" required onchange="updateInfo()"></select>
              </label>
              <div class="alert alert-default-info mb-3" id="pembimbing-info">
              </div>
            <?php else : ?>
              <p><i>Pilihan dosen pembimbing tidak dapat diganti saat ini</i></p>
            <?php endif ?>
            <div class="d-flex mb-3">
              <input type="submit" value="Simpan" class="btn btn-primary mr-auto">
            </div>
          </form>
        </div>
        <script>
          let dosenInfo = {};
          window.addEventListener('DOMContentLoaded', (event) => {
            $('#tema').on('change', function(e) {
              var p = $('#pembimbing');
              p.empty();
              dosenInfo = {};
              fetch('/user/api_checkseats?tema=' + $('#tema').val()).then(x => x.json()).then(x => {
                if (x.length > 0) {
                  x.forEach(y => {
                    $('<option>').attr('value', y.nid).text(`${y.nama} - (sisa ${y.seats} slot)`).appendTo(p);
                    dosenInfo[y.nid] = y;
                  })
                } else {
                  $('<option>').attr('value', '').prop('disabled', true).
                  text(`Tidak ada dosen tersedia disini`).appendTo(p);
                }
                updateInfo();
              })
            });
            updateInfo();
          });

          function updateInfo() {
            let v = $('#pembimbing').val();
            $('#pembimbing-info').text(v ? dosenInfo[v].deskripsi : 'Pilih dosen');
          }
        </script>
      </div>
    </div>
  </div>
</body>

</html>