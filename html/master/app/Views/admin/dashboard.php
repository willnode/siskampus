<?php

/** @var Shared\Entities\Operator $user */ ?>
<!doctype html>
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
      <div class="container">
        <div class="card">
          <div class="card-body">
            <h1>Selamat Datang di Admin Center</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>