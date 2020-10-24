<div class="input-group">
    <?php if ($disabled) : ?>
        <input type="text" value="<?= esc($value) ?>" name="<?= $name ?>" class="form-control" disabled>
    <?php else : ?>
        <input type="file" name="<?= $name ?>" id="<?= $name ?>" class="form-control">
    <?php endif ?>
    <?php if ($value) : ?>
        <?php if (!$disabled) : ?>
            <button type="button" class="btn btn-danger" onclick="this.form['<?= $name ?>'].parentElement.innerHTML = `<input type='hidden' name='<?= $name ?>' value='delete'><i class='form-control'>Akan dihapus</i>`"><i class="fa fa-trash"></i></button>
        <?php endif ?>
        <a href="<?= get_file($path, $value) ?>" class="btn btn-success"><i class="fa fa-download"></i></a>

    <?php endif ?>
</div>