<?php

namespace App\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property int $entri_id
 * @property int $indi
 * @property int $subindi
 * @property string $pertanyaan
 * @property string $pernyataan
 */
class Responden extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'entri_id' => 'integer',
        'indi' => 'integer',
        'subindi' => 'integer',
    ];
}
