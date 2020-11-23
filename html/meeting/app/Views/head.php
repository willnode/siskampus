<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= (($title ?? '') ? $title . ' - ' : '') . \Config\Services::site()->shared->short_name ?></title>
<link rel="shortcut icon" href="<?= static_url('logo.png') ?>">
<link href="<?= module_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?= module_url('select2/dist/css/select2.min.css') ?>" rel="stylesheet">
<link href="<?= module_url('@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css"') ?>" rel="stylesheet">
<link href="<?= module_url('datatables.net-dt/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
<link href="<?= module_url('datatables.net-select-bs4/css/select.bootstrap4.min.css') ?>" rel="stylesheet">
<link href="<?= module_url('@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
<link href="<?= static_url('style.css') ?>" rel="stylesheet">
<script defer src="<?= module_url('jquery/dist/jquery.min.js') ?>"></script>
<script defer src="<?= module_url('bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script defer src="<?= module_url('select2/dist/js/select2.min.js') ?>"></script>
<script defer src="<?= module_url('datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script defer src="<?= module_url('datatables.net-select/js/dataTables.select.min.js') ?>"></script>