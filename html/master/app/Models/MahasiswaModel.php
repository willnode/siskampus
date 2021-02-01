<?php

namespace App\Models;

use App\Entities\Mahasiswa;
use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table         = 'mahasiswa';
    protected $allowedFields = [
        'nim', 'nama', 'prodi', 'angkatan'
    ];
    protected $primaryKey = 'nim';
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
        $b->select('angkatan, COUNT(nim) as jumlah');
        $b->groupBy('angkatan');
        return $b->get()->getResult($this->returnType);
    }


    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new Mahasiswa($_POST));
            $id = $this->insert($item);
            return $id;
        } else if ($item = $this->find($id)) {
            /** @var Mahasiswa $item */
            $item->fill($_POST);
            if ($item->hasChanged()) {
                $this->save($item);
            }
            return $id;
        }
        return false;
    }
}
