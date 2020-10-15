<?php

namespace Shared\Models;

use Shared\Models\BaseModel;

class SiteModel extends BaseModel
{
    protected $table      = 'master.site';
    protected $finalEntity = 'Shared\Entities\Site';

    public function get()
    {
        return $this->find(1);
    }
}
