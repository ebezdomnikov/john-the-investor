<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Fico7489\Laravel\Pivot\Traits\PivotEventTrait;

class Company extends Model
{
    use PivotEventTrait;

    public $timestamps = null;

    public static function boot()
    {
        parent::boot();

        static::pivotDetaching(function ($model, $relationName, $pivotIds) {
            if ($relationName === 'stocks') {
                $hasPrices = CompanyStock::whereIn('stock_id', $pivotIds)
                    ->where('company_id', $model->id)
                    ->whereHas('prices')
                    ->exists();
                if ($hasPrices) {
                    throw new \Exception("The stocks are connected to markets, please unlink them first");
                }
            }
        });

        static::deleting(function($model) {
            $hasStocks = CompanyStock::where('company_id', $model->id)
                ->exists();
            if ($hasStocks) {
                throw new \Exception("The stocks are connected to stocks, please unlink them first");
            }

            $hasMarkets = CompanyStock::where('company_id', $model->id)
                ->whereHas('prices')
                ->exists();
            if ($hasMarkets) {
                throw new \Exception("The stocks are connected to markets, please unlink them first");
            }
        });
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class,
            'company_stocks'
        );
    }

    public function markets()
    {
        return $this->hasManyThrough(MarketPrice::class, CompanyStock::class)->groupBy('market_id');
    }
}
