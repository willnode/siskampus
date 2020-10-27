<?php

namespace Shared\Models;

class RoomModel extends BaseModel
{
    protected $table      = 'master.room';
    protected $finalEntity = 'Shared\Entities\Room';

    protected $i18nFields = ['name'];

    public function makeDropdownOptions($selected)
    {
?>
        <?php /** @var \Shared\Entities\Room $room */ ?>
        <?php foreach ($this->findAll() as $room) : ?>
            <option <?= $selected === $room->id ? 'selected' : '' ?> value="<?= esc($room->id) ?>"><?= esc($room->name) ?></option>
        <?php endforeach ?>
<?php
    }
}
