<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= (($title ?? '') ? $title . ' - ' : '') . \Config\Services::site()->shared->short_name  ?></title>
<link rel="shortcut icon" href="<?= static_url('logo.png') ?>">
<link href="<?= module_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?= module_url('@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
<link href="<?= static_url('style.css') ?>" rel="stylesheet">
<script defer src="<?= module_url('bootstrap/dist/js/bootstrap.min.js') ?>"></script>