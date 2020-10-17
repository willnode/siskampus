<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>

</head>

<body>

  <?= view('navbar') ?>

  <div class="container-fluid my-3">
    <?php /** @var \App\Entities\Proposal $item */ ?>
    <div class="row">
      <div class="col-md-6 col-lg-4 mb-3">
        <?php $status = ($rvs = explode('-', $item->status, 2))[0] ?>
        <div class="card" style="overflow-y: auto; height: calc(100vh - 8rem)">
          <div class="card-body">
            <div><?= ($s = $item->student)->id ?> &bullet; <?= $s->program->name ?></div>
            <h3><?= $s->name ?></h3>
            <h4 class="my-3 mr-auto">
              <span class="badge bg-<?= lang('Proposal.statutes-color')[($status)] ?>">
                <?= lang('Proposal.statutes')[$status] ?>
              </span>
            </h4>
            <div><b>Diperbarui: </b><?= $item->updated_at->humanize() ?></div>
            <div><b>RMK: </b><?= $item->expertise->name ?></div>
            <div><b>Pembimbing: </b></div>
            <ul>
              <?php foreach ($item->lecturer as $lecturer) : ?>
                <li>
                  <?= esc($lecturer->name) ?>
                  <?= array_search($lecturer->id, $rvs) ? '<span class="badge bg-success">Disetujui</span>' : '' ?>
                </li>
              <?php endforeach ?>
            </ul>
            <form method="POST" class="d-flex mb-3 align-items-center">
              <a href="/proposal" class="btn btn-outline-secondary btn-sm">
                <img src="<?= module_url('bootstrap-icons/icons/arrow-left-circle-fill.svg') ?>" />
              </a>
              <?php if ($type === 'lecturer') : ?>
                <?php if ($status === 'pending' && !array_search($user->id, $rvs)) : ?>
                  <button name="action" value="accept" class="mx-2 btn-sm flex-grow-1 btn btn-primary">Setujui</button>
                  <button name="action" value="reject" class="btn btn-sm btn-danger">
                    <img src="<?= module_url('bootstrap-icons/icons/trash.svg') ?>" />
                  </button>
                <?php elseif ($status === 'pending') : ?>
                  <div class="text-muted flex-grow-1 text-center small">Anda sudah menyetujui ini.</div>
                <?php else : ?>
                  <div class="text-muted flex-grow-1 text-center small">Proposal ini tidak dalam masa review.</div>
                <?php endif ?>
              <?php endif ?>
            </form>
            <hr>
            <h3><?= $item->title ?></h3>
            <p><?= $item->abstract ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-8 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <object data="<?= get_file('research/proposal', $item->file, 'embeds') ?>" type="application/pdf" class="h-100 w-100">
              <a href="<?= get_file('research/proposal', $item->file, 'embeds') ?>">View in browser</a>
            </object>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>