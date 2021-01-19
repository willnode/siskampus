<!DOCTYPE html>
<html lang="en">
<?= view('head') ?>

<body>
  <div class="wrapper">
    <?= view('navbar') ?>

    <?php /** @var \App\Entities\User $item */ ?>
    <div class="container p-4" style="max-width: 540px;">
      <div class="card">
        <div class="card-body">
          <form enctype="multipart/form-data" method="post">
            <div class="d-flex mb-3">
              <h1 class="h3 mb-0 mr-auto">Edit Profil</h1>
              <a href="/user/" class="btn btn-outline-secondary ml-2">Kembali</a>
            </div>
            <?php if ($item->role === 'mahasiswa') : ?>
              <label class="d-block mb-3">
                <span>Nama</span>
                <input type="text" class="form-control" value="<?= esc($item->name) ?>" disabled>
              </label>
              <label class="d-block mb-3">
                <span>NIM</span>
                <input type="text" class="form-control" value="<?= esc($item->username) ?>" disabled>
              </label>
            <?php else : ?>
              <label class="d-block mb-3">
                <span>Nama</span>
                <input type="text" class="form-control" name="name" value="<?= esc($item->name) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Username</span>
                <input type="text" class="form-control" name="username" value="<?= esc($item->username) ?>" required>
              </label>
            <?php endif ?>
            <label class="d-block mb-3">
              <span>Avatar</span>
              <?= shared_view('form/file', [
                'value' => $item->avatar,
                'name' => 'avatar',
                'path' => 'avatar',
                'disabled' => false,
              ]) ?>
            </label>
            <label class="d-block mb-3">
              <span>Password</span>
              <input type="password" class="form-control" name="password" placeholder="<?= $item->id ? 'Masukkan password baru jika ingin dirubah' : '" required="required' ?>">
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