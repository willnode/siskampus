<?php

/** @var Shared\Entities\Lecturer $user */ ?>
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
                  <td>Nomor Bank</td>
                  <td><?= $user->bank ?></td>
                </tr>
              </tbody>
            </table>
            <h4>Identitas</h4>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td width="150px">NID</td>
                  <td><?= $user->id ?></td>
                </tr>
                <tr>
                  <td>NIP</td>
                  <td><?= $user->nip ?></td>
                </tr>
                <tr>
                  <td>NIDN</td>
                  <td><?= $user->nidn ?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td><?= lang('Student.statuses')[$user->status] ?></td>
                </tr>
                <tr>
                  <td>Departemen</td>
                  <td><?= ($department = $user->department)->name ?></td>
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

      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <a class="btn btn-outline-primary d-block my-1" href="/go/meeting"><i class="fa fa-handshake mr-2"></i> Pertemuan</a>
            <a class="btn btn-outline-primary d-block my-1" href="/go/course"><i class="fa fa-book mr-2"></i>Perkuliahan</a>
            <a class="btn btn-outline-primary d-block my-1" href="/go/research"><i class="fa fa-scroll mr-2"></i>Tugas Akhir</a>
            <a class="btn btn-outline-primary d-block my-1" href="/go/payment"><i class="fa fa-wallet mr-2"></i>Pembayaran</a>
            <a class="btn btn-outline-primary d-block my-1" href="/go/welcome"><i class="fa fa-door-open mr-2"></i>Registrasi</a>
            <a class="btn btn-outline-primary d-block my-1" href="/go/inventory"><i class="fa fa-building mr-2"></i>Inventaris</a>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>