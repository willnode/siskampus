<div>
    <?php foreach ($actions as $value) : ?>
        <?php switch ($value) {
            case 'delete':
        ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-danger"><i class="fa fa-delete"></i></a>
            <?php
                break;
            case 'edit':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-warning"><i class="fa fa-edit"></i></a>
            <?php
                break;
            case 'detail':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-primary"><i class="fa fa-info-circle"></i></a>
            <?php
                break;
            case 'add':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-success"><i class="fa fa-plus-circle"></i></a>
            <?php
                break;
            case 'view':
            ?>
                <a href="?view=<?= ($_GET['view'] ?? '') === 'grid' ? 'list' : 'grid' ?>" class="btn <?= $size ?> btn-info"><i class="fa fa-<?= ($_GET['view'] ?? '') === 'grid' ? 'list' : 'th' ?>"></i></a>
            <?php
                break;
            case 'export':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-success"><i class="fa fa-download"></i></a>
            <?php
                break;
            case 'import':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-primary"><i class="fa fa-upload"></i></a>
            <?php
                break;
            case 'archived':
            ?>
                <a href="?<?= http_build_query(array_merge($_GET, [
                                'archived' =>  empty($_GET['archived']) ? '1' : ''
                            ])) ?>" class="btn <?= $size ?> <?= empty($_GET['archived']) ? 'btn-dark' : 'btn-outline-dark' ?>"><i class="fa <?= empty($_GET['archived']) ? 'fa-file-archive' : 'fa-file' ?>"></i></a>
        <?php
                break;
        } ?>
    <?php endforeach ?>
</div>