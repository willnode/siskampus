<?php

namespace App\Models;

use App\Entities\Pembimbing;
use CodeIgniter\Model;
use Config\Services;

class PembimbingModel extends Model
{
    public static $temas = [
        'keagamaan',
        'pendidikan',
        'pertanian',
        'teknologi',
    ];
    protected $table         = 'pembimbing';
    protected $allowedFields = [
        'nid', 'nama', 'hp', 'email', 'tema', 'deskripsi'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Pembimbing';

    public function withAvailableSeats($tema)
    {
        $b = $this->builder();
        if ($tema) {
            $b->where('tema', $tema);
        }
        $b->select("nid, pembimbing.nama, deskripsi, 9-COALESCE(COUNT(nim), 0) as seats");
        $b->join('pendaftar', 'pendaftar.pembimbing = pembimbing.nid', 'left');
        $b->where("(status != 'selesai' or isnull(status))");
        $b->groupBy("nid");
        return $b->get()->getResult($this->returnType);
    }
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
