<div class="row g-2 my-3">
    <?php if ($data) : ?>
        <?php foreach ($data as $item) : ?>
            <div class="col-lg-4 col-md-6 my-2">
                <?php $render($item) ?>
            </div>
        <?php endforeach ?>
    <?php else : ?>
        <div class="alert alert-secondary text-center my-5">
            Data saat ini sedang kosong
        </div>
    <?php endif ?>
</div>