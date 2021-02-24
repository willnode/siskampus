<?php

namespace App\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property int $entri_id
 * @property int $user_id
 * @property int $tahun
 * @property string $jawaban
 * @property float $score
 * @property string $status
 * @property Time $created_at
 * @property Time $updated_at
 */
class Responden extends Entity
{
    protected $casts = [
        'id' => 'integer',
    ];
}
