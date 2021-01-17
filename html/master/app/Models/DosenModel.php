<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class DosenModel extends Model
{
    protected $table         = 'dosen';
    protected $allowedFields = [
        'nama', 'id', 'departemen'
    ];
    protected $primaryKey = 'nis';
    protected $returnType = 'App\Entities\Dosen';

    public function withAktif()
    {
        $b = $this->builder();
        $y = Services::config()->tahun;
        $b->where('thn_masuk between ' . ($y - 2) . ' and ' . $y);
        return $this;
        # code...
    }
    public function withKelas($id)
    {
        if ($id) {
            $id = explode(',', $id);
            $this->builder()->where([
                'thn_masuk' => $id[0] ?? '',
                'kelas' => $id[1] ?? '',
            ]);
        }
        return $this;
        # code...
    }
    public function allKelas()
    {
        $b = $this->builder();
        $b->select('kelas, thn_masuk, COUNT(nis) as jumlah');
        $b->groupBy('kelas, thn_masuk');
        return $b->get()->getResult($this->returnType);
    }
}
