<?php

namespace Shared\Models;

class DepartmentModel extends BaseModel
{
    protected $table      = 'master.department';
    protected $finalEntity = 'Shared\Entities\Department';
    protected $i18nFields = ['name'];

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
