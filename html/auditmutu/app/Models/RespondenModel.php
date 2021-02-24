<?php

namespace App\Models;

use App\Entities\Mahasiswa;
use App\Entities\Pendaftar;
use CodeIgniter\Model;
use Config\Database;
use Config\Services;

class PendaftarModel extends Model
{

    public static $statuses = [
        'pengisian',
        'penilaian',
        'selesai',
    ];

    public static $statusesInHtml = [
        'pengisian' => '<span class="badge badge-info">Masa Pengisian</span>',
        'penilaian' => '<span class="badge badge-warning">Sedang Dinilai</span>',
        'selesai' => '<span class="badge badge-success">Sudah Selesai</span>',
    ];

    protected $table         = 'responden';
    protected $allowedFields = [
        'entri_id', 'user_id', 'tahun', 'jawaban', 'score', 'status'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Responden';
    protected $useTimestamps = true;


    public function withAktif($aktif = true)
    {
        if ($aktif) {
            $this->builder()->where("status != 'selesai'");
        } else {
            $this->builder()->where("status = 'selesai'");
        }
        return $this;
        # code...
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new Pendaftar($_POST));
            $um = Services::user()->getMasterData();
            $item->nama = $um->nama;
            $item->nim = $um->nim;
            $item->prodi = $um->prodi;
            $item->status = 'ditinjau';
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
