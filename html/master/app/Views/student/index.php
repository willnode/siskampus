<?php

/** @var Shared\Entities\Student $user */ ?>
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
                  <td>Email</td>
                  <td><?= $user->email ?></td>
                </tr>
                <tr>
                  <td>HP</td>
                  <td><?= $user->phone ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td><?= $user->address ?></td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td><?= $user->birth_date ?></td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td><?= $user->birth_place ?></td>
                </tr>
              </tbody>
            </table>
            <h4>Kemahasiswaan</h4>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td width="150px">NRP</td>
                  <td><?= $user->id ?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td><?= lang('Student.statuses')[$user->status] ?></td>
                </tr>
                <tr>
                  <td>Angkatan</td>
                  <td><?= $user->class_of ?></td>
                </tr>
                <tr>
                  <td>Program Studi</td>
                  <td><?= ($program = $user->program)->name ?></td>
                </tr>
                <tr>
                  <td>Departemen</td>
                  <td><?= ($department = $program->department)->name ?></td>
                </tr>
                <tr>
                  <td>Fakultas</td>
                  <td><?= ($faculty = $department->faculty)->name ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>