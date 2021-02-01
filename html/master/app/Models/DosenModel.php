<?php

namespace App\Models;

use App\Entities\Dosen;
use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table         = 'dosen';
    protected $allowedFields = [
        'nama', 'nid', 'departemen'
    ];
    protected $primaryKey = 'nid';
    protected $returnType = 'App\Entities\Dosen';

    /** @return Mahasiswa|null */
    public function atNid($nid)
    {
        return  $this->builder()->where([
            'nid' => $nid,
        ])->get()->getRow(0, $this->returnType);
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new Dosen($_POST));
            $id = $this->insert($item);
            return $id;
        } else if ($item = $this->find($id)) {
            /** @var Dosen $item */
            $item->fill($_POST);
            if ($item->hasChanged()) {
                $this->save($item);
            }
            return $id;
        }
        return false;
    }
}
