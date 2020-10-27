<!doctype html>
<html lang="id">

<head>
  <?= view('head') ?>
</head>

<body>

  <?= view('navbar') ?>

  <div class="container my-5">
    <h3>Edit Biodata</h3>
    <form method="POST" enctype="multipart/form-data" class="row">
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <?php /** @var \Shared\Entities\Student $user */ ?>
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" name="name" id="name" class="form-control" value="<?= esc($user->name) ?>" <?= $free && isset($unlocked['name']) ? '' : 'disabled' ?>>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name" class="form-label">Email</label>
                  <input type="text" name="email" id="email" class="form-control" value="<?= esc($user->email) ?>" <?= $free && isset($unlocked['email']) ? '' : 'disabled' ?>>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name" class="form-label">HP</label>
                  <input type="text" name="phone" id="phone" class="form-control" value="<?= esc($user->phone) ?>" <?= $free && isset($unlocked['phone']) ? '' : 'disabled' ?>>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Alamat</label>
              <input type="text" name="address" id="address" class="form-control" value="<?= esc($user->address) ?>" <?= $free && isset($unlocked['address']) ? '' : 'disabled' ?>>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Tempat dan Tanggal Lahir</label>
              <div class="input-group">
                <input type="text" name="birth_place" id="birth_place" class="form-control" value="<?= esc($user->birth_place) ?>" <?= $free && isset($unlocked['birth_place']) ? '' : 'disabled' ?>>
                <input type="date" name="birth_date" id="birth_date" class="form-control" value="<?= esc($user->birth_date) ?>" <?= $free && isset($unlocked['birth_date']) ? '' : 'disabled' ?>>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="id" class="form-label">NRP</label>
              <input type="text" name="id" id="id" class="form-control" value="<?= esc($user->id) ?>" disabled>
            </div>
            <div class="mb-3">
              <label for="id" class="form-label">Foto Profil</label>
              <?= shared_view('form/file', ['name' => 'avatar', 'value' => $user->avatar, 'path' => 'master/avatar', 'disabled' => !$free || !isset($unlocked['avatar'])]) ?>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="id" class="form-label">Angkatan</label>
                  <input type="text" name="class_of" id="class_of" class="form-control" value="<?= esc($user->class_of) ?>" <?= $free && isset($unlocked['class_of']) ? '' : 'disabled' ?>>
                </div>
              </div>
              <div class="col-md-8">
                <div class="mb-3">
                  <label for="program_id" class="form-label">Program Studi</label>
                  <?php if ($free && isset($unlocked['program_id'])) : ?>
                    <select class="form-select" name="program_id" id="program_id">
                      <?php (new \Shared\Models\ProgramModel())->renderOptions($user->program_id)  ?>
                    </select>
                  <?php else : ?>
                    <input type="text" name="program_id" id="program_id" class="form-control" value="<?= esc($user->program->name ?? '') ?>" disabled>
                  <?php endif ?>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password Baru</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Kosongi bila tidak ingin diganti">
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex mb-3">
        <a href="/" class="btn btn-secondary">Kembali</a>
        <input type="submit" value="Simpan" class="ml-auto btn btn-primary">
      </div>
    </form>
  </div>

</body>

</html>