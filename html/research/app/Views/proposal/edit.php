<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>

</head>

<body>

  <?= view('navbar') ?>

  <div class="container-fluid my-5">
    <?php /** @var \App\Entities\Proposal $item */ ?>
    <form class="row" method="POST" enctype='multipart/form-data'>
      <div class="col-md-6 col-lg-4 mb-3">
        <div class="card" id="form" data-department="<?= esc($user->program->department_id ?? $item->student->program->department_id) ?>">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Judul</label>
              <input class="form-control" name="title" value="<?= esc($item->title) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Abstrak</label>
              <textarea name="abstract" class="form-control" rows="10" required><?= esc($item->abstract) ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">RMK</label>
              <select disabled name="expertise_id" id="expertise_id" class="form-select" required>
                <option selected value="<?= esc($item->expertise_id) ?>"><?= esc($item->expertise->name) ?></option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Berkas Proposal</label>
              <input type="file" class="form-control" name="file" accept="application/pdf" <?= $item->id ? '' : 'required' ?>>
            </div>
            <?php if ($type === 'operator') : ?>
              <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                  <?php foreach ((array)lang('Proposal.statutes') as $key => $value) : ?>
                    <option <?= $key === $item->status ? 'selected' : '' ?> value="<?= $key ?>"><?= esc($value) ?></option>
                  <?php endforeach ?>
                </select>

                <?php if ($item->status !== 'final') : ?>
                  <div class="text-right">

                    <button name="action" value="choose" class="btn btn-outline-success my-1 btn-sm">
                      Pilih sebagai final
                    </button>
                  </div>
                <?php endif ?>
              </div>
            <?php endif ?>
            <div class="mb-3 d-flex">
              <input type="submit" class="btn btn-primary" value="Submit">
              <a href="/proposal" class="ml-auto btn btn-outline-secondary">Batalkan</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-8 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <?php $lecturers = $item->lecturer ?>
              <?php for ($i = 0; $i < 2; $i++) : ?>
                <div class="col-lg-6 mb-3">
                  <label class="form-label">Dosen Pembimbing <?= $i + 1 ?></label>
                  <input type="hidden" required id="lecturer_id_<?= $i ?>" name="lecturer_id[<?= $i ?>]" value="<?= esc($lecturers[$i]->id ?? '') ?>">
                  <input type="text" required class="form-control" readonly placeholder="Silahkan pilih dosen" id="lecturer_id_<?= $i ?>_name" value="<?= esc($lecturers[$i]->name ?? '') ?>">
                </div>
              <?php endfor ?>
            </div>
            <table id="table">
              <thead>
                <th>1</th>
                <th>2</th>
                <th>NID</th>
                <th>Nama</th>
                <th>Alokasi</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </form>

  </div>
  <script>
    var department = $('#form').data('department');

    (function(select, uri) {
      fetch(uri + '?department_id=' + department).then(x => x.json()).then(x => {
        var d = select.val();
        select.html('<option></option>' + x.map(y => `
        <option value="${y.id}" ${d == y.id ? 'selected' : ''}>${y.name}</option>
      `).join(''))
        select.prop('disabled', false);
      })
    })($('#expertise_id'), '/api/expertises');

    fetch('/api/lecturers?department_id=' + department).then(x => x.json()).then(x => {
      $('#table').DataTable({
        data: x,
        columns: [
          ...[0, 1].map(i => ({
            data: 'id',
            orderable: false,
            width: 1,
            render: function(data, type, row, meta) {
              return row.free > 0 ? `<button type="button" class="btn btn-sm btn-success pb-2"
                onclick="selectLecturer(${i}, \`${row.id}\`, \`${row.name}\`)">
              <img src="<?= module_url('bootstrap-icons/icons/plus-square.svg') ?>"
                style="filter: contrast(0) brightness(2);" />
              </button>` : '';
            }
          })),
          {
            width: 1,
            data: 'id',
          },
          {
            data: 'name'
          },
          {
            width: 1,
            data: 'free',
          }
        ]
      });
    });

    function selectLecturer(i, id, name) {
      $(`#lecturer_id_${i}`).val(id);
      $(`#lecturer_id_${i}_name`).val(name);
    }
  </script>
</body>