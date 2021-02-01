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
                <h1 class="h3 mb-0 mr-auto">Edit User</h1>
                <a href="/admin/mahasiswa/" class="btn btn-outline-secondary ml-2">Kembali</a>
              </div>
              <label class="d-block mb-3">
                <span>Nama Lengkap</span>
                <input type="text" class="form-control" name="name" value="<?= esc($item->name) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Username</span>
                <input type="text" class="form-control" name="username" value="<?= esc($item->username) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Password</span>
                <input type="password" class="form-control" name="password" placeholder="<?= $item->id ? 'Only enter when you want to change your password' : '" required="required' ?>">
              </label>
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
                <span>Role</span>
                <select name="role" class="form-control">
                  <?= implode('', array_map(function ($x) use ($item) {
                    return '<option ' . ($item->role === $x ? 'selected' : '') .
                      ' value="' . $x . '">' . ucfirst($x) . '</option>';
                  }, \Shared\Models\UserModel::$roles)) ?>
                </select>
                <p>Untuk role mhs/dosen pastikan username ada di data NIM/NID.</p>
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

  <form method="POST" action="/admin/user/delete/<?= $item->id ?>">
    <input type="submit" hidden id="delete-form" onclick="return confirm('Do you want to delete this user permanently?')">
  </form>
</body>

</html>