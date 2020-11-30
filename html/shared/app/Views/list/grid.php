<div class="row g-2">
    <?php foreach ($data as $item) : ?>
        <div class="col-lg-4 col-md-6 my-2">
            <?php $render($item) ?>
        </div>
    <?php endforeach ?>
</div>
