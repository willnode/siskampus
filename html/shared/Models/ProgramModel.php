<?php

namespace Shared\Models;

class ProgramModel extends BaseModel
{
    protected $table      = 'master.program';
    protected $finalEntity = 'Shared\Entities\Program';
    protected $i18nFields = ['name'];

    public function makeDropdownOptions($selected)
    {
?>
        <?php /** @var \Shared\Entities\Program $program */ ?>
        <?php foreach ($this->findAll() as $program) : ?>
            <option <?= $selected === $program->id ? 'selected' : '' ?> value="<?= esc($program->id) ?>"><?= esc($program->name) ?></option>
        <?php endforeach ?>
<?php
    }
}
