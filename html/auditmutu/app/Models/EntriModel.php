<?php

namespace App\Models;

use App\Entities\Pembimbing;
use CodeIgniter\Model;
use Config\Services;

class EntriModel extends Model
{
    protected $table         = 'entri';
    protected $allowedFields = [
        'id', 'user_id', 'judul'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Entri';

    /** @return Pembimbing|null */
    public function atNid($nid)
    {
        return  $this->builder()->where([
            'nid' => $nid,
        ])->get()->getRow(0, $this->returnType);
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new Pembimbing($_POST));
            $um = Services::user()->getMasterData();
            $item->nama = $um->nama;
            $item->nid = $um->nid;
            $id = $this->insert($item);
            return $id;
        } else if ($item = $this->find($id)) {
            $item->fill($_POST);
            if ($item->hasChanged()) {
                $this->save($item);
            }
            return $id;
        }
        return false;
    }
}
