<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $timestamps = null;

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
