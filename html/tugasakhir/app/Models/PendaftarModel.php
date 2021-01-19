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
        'ditinjau',
        'ditolak',
        'pengerjaan',
        'seminar',
        'selesai',
    ];
    public static $statusesInHtml = [
        'ditinjau' => '<span class="badge badge-info">Sedang Ditinjau</span>',
        'ditolak' => '<span class="badge badge-danger">Ditolak oleh Pembimbing</span>',
        'pengerjaan' => '<span class="badge badge-success">Disetujui</span>',
        'seminar' => '<span class="badge badge-warning">Masa Seminar</span>',
        'selesai' => '<span class="badge badge-dark">Selesai</span>',
    ];
    protected $table         = 'pendaftar';
    protected $allowedFields = [
        'nim', 'nama', 'prodi', 'hp', 'status', 'judul', 'pembimbing'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Pendaftar';
	protected $useTimestamps = true;

    public function withPembimbing($nid, $aktif = true)
    {
        if ($nid) {
            $this->builder()->where([
                'pembimbing' => $nid,
            ]);
        }
        if ($aktif) {
            $this->builder()->where("status != 'status'");
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
