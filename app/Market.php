<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    public $timestamps = null;

    public static function boot()
    {
        parent::boot();

//        static::pivotDetaching(function ($model, $relationName, $pivotIds) {
//            if ($relationName === 'stocks') {
//                $hasPrices = CompanyStock::whereIn('stock_id', $pivotIds)
//                    ->where('company_id', $model->id)
//                    ->whereHas('prices')
//                    ->exists();
//                if ($hasPrices) {
//                    throw new \Exception("The stocks are connected to markets, please unlink them first");
//                }
//            }
//        });

        static::deleting(function($model) {
           $hasPrices = (Market::whereHas('prices')->find($model->id) !== null);
            if ($hasPrices) {
                throw new \Exception("The market have the prices, please unlink them first");
            }
        });
    }

    public function prices()
    {
        return $this->hasMany(MarketPrice::class, 'market_id', 'id');
    }
}
