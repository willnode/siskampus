<?php

namespace Shared\Models;

class FacultyModel extends BaseModel
{
    protected $table      = 'master.faculty';
    protected $finalEntity = 'Shared\Entities\Faculty';

    public function makeDropdownOptions($selected)
    {
?>
        <?php /** @var \Shared\Entities\Faculty $faculty */ ?>
        <?php foreach ($this->findAll() as $faculty) : ?>
            <option <?= $selected === $faculty->id ? 'selected' : '' ?> value="<?= esc($faculty->id) ?>"><?= esc($faculty->name) ?></option>
        <?php endforeach ?>
<?php
    }
}
