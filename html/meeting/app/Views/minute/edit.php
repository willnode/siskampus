<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('head') ?>
</head>

<body>

  <?= view('navbar') ?>
  <div class="container-fluid my-5">
    <?php /** @var \App\Entities\Minute $item */ ?>
    <form class="row" method="POST" enctype='multipart/form-data'>
      <div class="col-md-6 col-lg-4 mb-3">
        <div class="card" id="form" data-department="<?= esc($user->department_id) ?>">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Judul</label>
              <input class="form-control" name="title" value="<?= esc($item->title) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Pemimpin</label>
              <select class="list-lecturers" name="chairman[id]" data-target="chairman">
                <option selected value="<?= esc($item->chairman->id) ?>"><?= esc($item->chairman->name) ?></option>
              </select>
              <div class="input-group">
                <input type="text" class="form-control" id="chairman_name" placeholder="Nama" name="chairman[name]" value="<?= esc($item->chairman->name) ?>">
                <input type="text" class="form-control" id="chairman_title" placeholder="Jabatan" name="chairman[title]" value="<?= esc($item->chairman->title) ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Notulen</label>
              <select class="list-lecturers" name="reporter[id]" data-target="reporter">
                <option selected value="<?= esc($item->reporter->id) ?>"><?= esc($item->reporter->name) ?></option>
              </select>
              <div class="input-group">
                <input type="text" class="form-control" id="reporter_name" placeholder="Nama" name="reporter[name]" value="<?= esc($item->reporter->name) ?>">
                <input type="text" class="form-control" id="reporter_title" placeholder="Jabatan" name="reporter[title]" value="<?= esc($item->reporter->title) ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Waktu</label>
              <input type="datetime-local" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Ruang</label>
              <select class="form-select">
                <?php (new \Shared\Models\RoomModel())->withDepartment(\Config\Services::user()->department_id)->renderOptions($item->room_id) ?>
              </select>
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
              <div class="col-lg-6 mb-3">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" name="note" rows="15"><?= esc($item->note) ?></textarea>
              </div>
              <div class="col-lg-6 mb-3">
                <table id="participants">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Nama</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-3">
                <div id="list-galleries">
                  <?php foreach ($item->galleries as $i => $value) : ?>
                    <?= view('form/file', [
                      'path' => 'meeting/gallery',
                      'value' => $value,
                      'name' => "galleries[$i]"
                    ]) ?>
                  <?php endforeach ?>
                </div>
                <button type="button" class="btn btn-block btn-primary" onclick="addFileForm('galleries')">
                  <i class="fa fa-plus mr-2"></i> Tambah Foto Kegiatan
                </button>
              </div>
              <div class="col-lg-6 mb-3">
                <div id="list-documents">
                  <?php foreach ($item->documents as $i => $value) : ?>
                    <?= view('form/file', [
                      'path' => 'meeting/gallery',
                      'value' => $value,
                      'name' => "documents[$i]"
                    ]) ?>
                  <?php endforeach ?>
                </div>
                <button type="button" class="btn btn-block btn-primary" onclick="addFileForm('documents')">
                  <i class="fa fa-plus mr-2"></i> Tambah Lampiran Dokumen
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>

  </div>
  <script id="lecturers">
    <?php (new \Shared\Models\LecturerModel())->withDepartment(\Config\Services::user()->department_id)->renderJSON() ?>
  </script>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      var lecturers = JSON.parse($('#lecturers').html()).reduce((a, b) => (a[b.id] = b, a), {});
      $('.list-lecturers').select2({
        data: Object.values(lecturers).map(x => ({
          id: x.id,
          text: x.name,
        })),
        placeholder: "Pilih",
        allowClear: true
      }).on('input', function() {
        var target = $(this).data('target');
        var value = $(this).val();
        console.log(value);
        if (value) {
          $(`#${target}_name`).val(lecturers[value].name).attr('type', 'hidden');
          $(`#${target}_title`).val(lecturers[value].title).prop('readonly', true);
        } else {
          $(`#${target}_name`).val('').attr('type', 'text');
          $(`#${target}_title`).val('').prop('readonly', false);
        }
      });
      $('select').select2({
        width: '100%',
      });
      $('#participants').DataTable({
        columns: [{
            data: 'id',
            render: () => ''
          }, {
            data: 'name',
          }
        ],
        columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0,
        }],
        data: Object.values(lecturers),
        select: {
          style: 'multi',
          selector: 'td:first-child',
        },
        order: [
          [1, 'asc']
        ],
        responsive: true,
        language: <?php (@include lang('Interface.datatables-lang')) ?: '{}' ?>
      });
    });

    function addFileForm(target) {
      $('#list-' + target).append(`<div class="input-group mb-1">
      <input type="file" name="${target}[]" class="form-control">
      <button type="button" class="btn btn-danger" onclick="deleteForm(this)">
      <i class="fa fa-trash"></i></button>
      </div>`);
    }

    function deleteForm(e) {
      $(e).parent().remove();
    }
  </script>
</body>