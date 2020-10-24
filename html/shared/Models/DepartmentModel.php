<?php

namespace Shared\Models;

class DepartmentModel extends BaseModel
{
    protected $table      = 'master.department';
    protected $finalEntity = 'Shared\Entities\Department';

    public function makeDropdownOptions($selected)
    {
?>
        <?php /** @var \Shared\Entities\Department $department */ ?>
        <?php foreach ($this->findAll() as $department) : ?>
            <option <?= $selected === $department->id ? 'selected' : '' ?> value="<?= esc($department->id) ?>"><?= esc($department->name) ?></option>
        <?php endforeach ?>
<?php
    }
}
