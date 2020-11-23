<?php

namespace Shared\Models;

class SiteModel extends BaseModel
{
    protected $table      = 'master.site';
    protected $finalEntity = 'Shared\Entities\Site';

    public function get()
    {
        return $this->find(1);
    }
}
