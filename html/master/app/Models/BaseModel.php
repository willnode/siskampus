<?php

namespace App\Models;

use CodeIgniter\Entity;
use CodeIgniter\Model;
use Config\Database;
use Config\Services;

class BaseModel extends Model
{
    protected $primaryKey = 'id';

    protected $afterFind = ['postProcessGet'];

    protected $finalEntity = '';

    protected $i18nFields = [];

    public function postProcessGet($event)
    {
        if (!isset($event['id'])) {
            foreach ($event['data'] as $key => $value) {
                $event['data'][$key] = $this->realPostProcessGet($value->id, json_decode($value->data));
            }
        } else {
            $event['data'] = $this->realPostProcessGet($event['data']->id, json_decode($event['data']->data));
        }
        return $event;
    }

    public function realPostProcessGet($id, $data)
    {
        $data->id = $id;
        if (!empty($data->i18n)) {
            $lang = Services::request()->getLocale();
            $i18n = $data->i18n->{$lang} ?? [];
            foreach ($i18n as $key => $value) {
                $data->$key = $value;
            }
            unset($i18n);
        }
        if ($this->finalEntity) {
            $data = new ${$this->finalEntity}($data);
        }
        return $data;
    }

    public function save($data): bool
    {
        if ($data instanceof Entity) {
            $data = $data->toRawArray();
        }
        $final = $data;
        unset($final['id']);
        if ($this->i18nFields) {
            $lang = Services::request()->getLocale();
            foreach ($this->i18nFields as $field) {
                if (isset($final[$field])) {
                    $final['i18n'][$lang][$field] = $final[$field];
                    unset($final[$field]);
                }
            }
        }
        $data = [
            'id' => $data['id'],
            'data' => json_encode($final),
        ];
        $sql = $this->builder()->set($data)->getCompiledInsert();
        $sql .= ' ON CONFLICT (id) DO UPDATE SET data = data::jsonb || excluded.data::jsonb ;';
        return Database::connect()->query($sql);
    }
}
