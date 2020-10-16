<?php

/** @var Shared\Entities\Student $user */ ?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mahasiswa</title>
  <link href="<?= module_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><?= $site->short_name ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/go/skripsi">Skripsi</a>
          </li>
        </ul>
        <form class="d-flex">
          <a class="mr-auto btn btn-outline-success" href="/logout">Logout</a>
        </form>
      </div>
    </div>
  </nav>

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
                  <td><?= $user->start_year ?></td>
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