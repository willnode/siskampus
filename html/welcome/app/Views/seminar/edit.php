<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('head') ?>

</head>

<body>

    <?= view('navbar') ?>

    <div class="container my-3">
        <div class="card">
            <div class="card-body">
                <?php /** @var \App\Entities\Seminar $item */ ?>
                <div>Proposal yang akan diseminarkan</div>
                <h4><?= $item->proposal->title ?></h4>
                <div><?= $item->proposal->student_id ?> &bullet; <?= $item->proposal->student->name ?></div>

            </div>
        </div>

        <div class="card">
            <form method="POST" class="card-body">
                <input type="hidden" name="proposal_id" value="<?= $item->proposal_id ?>">
                <div class="mb-3">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="datetime-local" name="start_at" class="form-control" value="<?= $item->start_at ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Waktu Selesai</label>
                    <input type="datetime-local" name="end_at" class="form-control" value="<?= $item->end_at ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ruang</label>
                    <select class="form-select" name="room_id">
                        <?php (new \Shared\Models\RoomModel())->renderOptions($item->room_id) ?>
                    </select>
                </div>
                <div class="mb-3 d-flex">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    <a href="/proposal" class="ml-auto btn btn-outline-secondary">Batalkan</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>