<?php

/** @var Shared\Entities\Operator $user */ ?>
<!doctype html>
<html lang="id">

<head>
  <?= view('head') ?>
</head>

<body>

  <?= view('navbar') ?>

  <div class="container my-5">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4>Biodata</h4>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td width="150px">Nama</td>
                  <td><?= $user->name ?></td>
                </tr>
                <tr>
                  <td>Username</td>
                  <td><?= $user->id ?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><?= $user->email ?></td>
                </tr>
                <tr>
                  <td>HP</td>
                  <td><?= $user->phone ?></td>
                </tr>
                <tr>
                  <td>Scope</td>
                  <td><?= $user->department->name ?? 'Semua Departemen' ?></td>
                </tr>
              </tbody>
            </table>
            <h4>Hak Akses</h4>
            <table class="table table-striped">
              <tbody>
                <?php foreach ($user->access as $item) : ?>
                  <tr>
                    <td><?= $item ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>