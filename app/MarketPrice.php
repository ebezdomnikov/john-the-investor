<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketPrice extends Model
{
    public function market()
    {
        return $this->hasOne(Market::class, 'id', 'market_id');
    }

    public function companyStock()
    {
        return $this->hasOne(CompanyStock::class, 'id', 'company_stock_id');
    }
}
