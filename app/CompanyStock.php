<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyStock extends Model
{
    public $timestamps = null;

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'id', 'stock_id');
    }

    public function prices()
    {
        return $this->hasMany(MarketPrice::class, 'company_stock_id', 'id');
    }
}
