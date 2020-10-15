<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property string $id
 * @property string $name
 * @property string $status
 * @property string $birth_date
 * @property string $birth_place
 * @property int $start_year
 * @property int $program_id
 * @property string $program
 */
class Student extends Entity
{
    protected $casts = [
        'start_year' => 'integer',
    ];

    protected $dates = [
		'birth_date',
	];
}