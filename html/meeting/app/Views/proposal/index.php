<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>
</head>

<body>

  <?= view('navbar') ?>

  <div class="container mb-5 mt-3">
    <div class="row">
      <?php if ($user->type !== 'student') : ?>
        <ul class="nav nav-tabs mb-3 mx-2">
          <?php foreach (['pending', 'review', 'final', 'rejected'] as $mode) : ?>
            <li class="nav-item">
              <a class="nav-link <?= $mode === ($_GET['mode'] ?? '') ? 'active' : '' ?>" href="?mode=<?= $mode ?>"><?= lang('Proposal.statutes')[$mode] ?></a>
            </li>
          <?php endforeach ?>
        </ul>
      <?php endif ?>
      <?php /** @var \App\Entities\Proposal[] $list */ ?>
      <?php if ($user->type !== 'operator') : ?>
        <?php foreach ($list as $item) : ?>
          <?php $status = ($rvs = explode('-', $item->status, 2))[0] ?>
          <?php $status === 'final' && $has_final = 1 ?>
          <?php if ($user->type === 'lecturer' && $status !== ($_GET['mode'] ?? '')) continue; ?>
          <div class="col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h4 class="m-0 mr-auto">
                    <span class="badge bg-<?= lang('Proposal.statutes-color')[($status)] ?>">
                      <?= lang('Proposal.statutes')[$status] ?>
                    </span></h4>

                  <a href="<?= get_file('research/proposal', $item->file) ?>" class="btn btn-success ml-2 btn-sm">
                    <i class="fa fa-download"></i>
                  </a>
                  <?php if (($user->type !== 'lecturer') && (($item->status) === 'pending' || $status === 'rejected')) : ?>
                    <a href="/proposal/<?= $item->id ?>" class="btn btn-warning ml-2 btn-sm">
                      <i class="fa fa-pencil-alt"></i>
                    </a>
                  <?php else : ?>
                    <a href="/proposal/<?= $item->id ?>" class="btn btn-info ml-2 btn-sm">
                      <i class="fa fa-eye"></i>
                    </a>
                  <?php endif ?>

                </div>

                <p><?= $item->student->id ?> &bullet; <?= $item->student->name ?> &bullet; <?= $item->expertise->name ?></p>
                <h3 class="mb-3"><?= esc(mb_strimwidth($item->title, 0, 150, "…")) ?></h3>
                <div><b>Diperbarui: </b> <?= $item->updated_at->humanize() ?></div>
                <div><b>Pembimbing: </b></div>
                <ul>
                  <?php foreach ($item->lecturer as $lecturer) : ?>
                    <li>
                      <?= esc($lecturer->name) ?>
                      <?= array_search($lecturer->id, $rvs) ? '<span class="badge bg-success">Disetujui</span>' : '' ?>
                    </li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
          </div>
        <?php endforeach ?>
        <?php if ($user->type === 'student' && !isset($has_final)) : ?>
          <div class="col-md-6 col-lg-4">
            <a href="/proposal/new" class="btn btn-success p-5 h-100 w-100 d-flex flex-column align-items-center justify-content-center">
              <i class="fa fa-plus-circle fa-3x"></i>
              <div class="my-3">Tambah Baru</div>
            </a>
          </div>
        <?php elseif (!isset($lecturer)) : ?>
          <p class="text-center text-muted">Tidak ada apapun disini</p>
        <?php endif ?>
      <?php else : ?>
        <table id="table" class="w-100">
          <thead>
            <tr>
              <th>NRP</th>
              <th>Mahasiswa</th>
              <th>Program Studi</th>
              <th>Judul</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
        <script>
          fetch('/api/proposals?mode=<?= $mode = $_GET['mode'] ?? '' ?>').then(x => x.json()).then(x => {
            $('#table').DataTable({
              data: x,
              responsive: true,
              columns: [{
                data: 'student.id',
              }, {
                data: 'student.name',
              }, {
                data: 'student.program.name',
              }, {
                data: 'title',
                orderable: false,
                render: function(data, type, row) {
                  return type === 'display' && data.length > 40 ?
                    data.substr(0, 40) + '…' :
                    data;
                }
              }, {
                orderable: false,
                render: function(data, type, row) {
                  return `
                  <?php if ($mode === 'final' && check_access($user, 'research/seminar')) : ?>
                    <a href="/seminar/new?from=${row.id}"  class="btn btn-info ml-2 btn-sm">
                      <i class="fa fa-clock"></i>
                    </a>
                  <?php endif ?>
                  <?php if (check_access($user, 'research/proposal')) : ?>
                    <a href="<?= get_file('research/proposal', '') ?>${row.file}"  class="btn btn-success ml-2 btn-sm">
                      <i class="fa fa-download"></i>
                    </a>
                    <a href="/proposal/${row.id}"  class="btn btn-warning ml-2 btn-sm">
                      <i class="fa fa-pencil-alt"></i>
                    </a>
                  <?php else/*if ($mode === 'review' && check_access($user, 'research/reviewer')) */ : ?>
                    <a href="/proposal/${row.id}"  class="btn btn-info ml-2 btn-sm">
                      <i class="fa fa-eye"></i>
                    </a>
                  <?php endif ?>
                  `
                }
              }, ],
              language: <?php (@include lang('Interface.datatables-lang')) ?: '{}' ?>
            })
          });
        </script>
      <?php endif ?>

    </div>
  </div>
</body>