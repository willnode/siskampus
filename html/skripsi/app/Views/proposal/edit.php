<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?= module_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= module_url('datatables.net-dt/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
  <script src="<?= module_url('jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= module_url('datatables.net/js/jquery.dataTables.min.js') ?>"></script>
</head>

<body>

  <?= view('navbar') ?>

  <div class="container-fluid my-5" enctype='multipart/form-data'>
    <?php /** @var \App\Entities\Proposal $item */ ?>
    <form class="row">
      <div class="col-md-6 col-lg-4 mb-3">
        <div class="card" id="form" data-department="<?= esc($user->program->department_id) ?>">
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
              <input type="file" class="form-control" name="proposal_file">
            </div>

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
                  <input type="hidden" id="lecturer_id_<?= $i ?>" name="lecturer_id[<?= $i ?>]" value="<?= esc($lecturers[$i]->id ?? '') ?>">
                  <input type="text" class="form-control" disabled id="lecturer_id_<?= $i ?>_name" value="<?= esc($lecturers[$i]->name ?? '') ?>">
                </div>
              <?php endfor ?>
            </div>
            <table id="table">
              <thead>
                <th>1</th>
                <th>2</th>
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
        columns: [{
            orderable: false,
            width: 1,
            render: function(data, type, row, meta) {
              return '<a href="' + data + '">Download</a>';
            }
          },
          {
            orderable: false,
            width: 1,
            render: function(data, type, row, meta) {
              return '<a href="' + data + '">Download</a>';
            }
          },
          {
            data: 'name'
          },
          {
            data: 'free'
          }
        ]
      });
    });
  </script>
</body>