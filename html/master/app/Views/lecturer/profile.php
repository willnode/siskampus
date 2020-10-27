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
            <?php /** @var \Shared\Entities\Lecturer $user */ ?>
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" name="name" id="name" class="form-control" value="<?= esc($user->name) ?>" <?= $free && isset($unlocked['name']) ? '' : 'disabled' ?>>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nip" class="form-label">NIP</label>
                  <input type="text" name="nip" id="nip" class="form-control" value="<?= esc($user->nip) ?>" <?= $free && isset($unlocked['nip']) ? '' : 'disabled' ?>>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nidn" class="form-label">NIDN</label>
                  <input type="text" name="nidn" id="nidn" class="form-control" value="<?= esc($user->nidn) ?>" <?= $free && isset($unlocked['nidn']) ? '' : 'disabled' ?>>
                </div>
              </div>
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
              <label for="name" class="form-label">Nomor Bank</label>
              <input type="text" name="bank" id="bank" class="form-control" value="<?= esc($user->bank) ?>" <?= $free && isset($unlocked['bank']) ? '' : 'disabled' ?>>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="id" class="form-label">NID</label>
              <input type="text" name="id" id="id" class="form-control" value="<?= esc($user->id) ?>" disabled>
            </div>
            <div class="mb-3">
              <label for="id" class="form-label">Foto Profil</label>
              <?= shared_view('form/file', ['name' => 'avatar', 'value' => $user->avatar, 'path' => 'master/avatar', 'disabled' => !$free || !isset($unlocked['avatar'])]) ?>
            </div>
            <div class="mb-3">
              <label for="department_id" class="form-label">Area Departemen</label>
              <?php if ($free && isset($unlocked['department_id'])) : ?>
                <select class="form-select" name="department_id" id="department_id">
                  <?php (new \Shared\Models\DepartmentModel())->renderOptions($user->department_id)  ?>
                </select>
              <?php else : ?>
                <input type="text" name="department_id" id="department_id" class="form-control" value="<?= esc($user->department->name ?? 'Semuanya') ?>" disabled>
              <?php endif ?>
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