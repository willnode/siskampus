<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class DosenModel extends Model
{
    protected $table         = 'dosen';
    protected $allowedFields = [
        'nama', 'nid', 'departemen'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Dosen';

    /** @return Mahasiswa|null */
    public function atNid($nid)
    {
        return  $this->builder()->where([
            'nid' => $nid,
        ])->get()->getRow(0, $this->returnType);
    }
}
