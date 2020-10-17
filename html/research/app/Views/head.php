<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= (($title ?? '') ? $title . ' - ' : '') . $site->short_name ?></title>
<link href="<?= module_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?= module_url('datatables.net-dt/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
<script src="<?= module_url('jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= module_url('datatables.net/js/jquery.dataTables.min.js') ?>"></script>