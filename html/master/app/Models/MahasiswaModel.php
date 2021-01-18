<?php

namespace App\Models;

use App\Entities\Mahasiswa;
use CodeIgniter\Model;
use Config\Services;

class MahasiswaModel extends Model
{
    protected $table         = 'mahasiswa';
    protected $allowedFields = [
        'nim', 'nama', 'prodi', 'angkatan'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Mahasiswa';

    public function withAngkatan($angkatan)
    {
        if ($angkatan) {
            $this->builder()->where([
                'angkatan' => $angkatan,
            ]);
        }
        return $this;
        # code...
    }
    /** @return Mahasiswa|null */
    public function atNim($nim)
    {
        return  $this->builder()->where([
            'nim' => $nim,
        ])->get()->getRow(0, $this->returnType);
    }
    public function allAngkatan()
    {
        $b = $this->builder();
        $b->select('angkatan, COUNT(id) as jumlah');
        $b->groupBy('angkatan');
        return $b->get()->getResult($this->returnType);
    }
}
