<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonScope;
use App\Traits\Searchable;
use App\Traits\GlobalStatus;
use App\Constants\Status;

class Currency extends Model
{
	use GlobalStatus, CommonScope, Searchable;

    protected $guarded = [];


    public function gateway_currency()
    {
        return $this->belongsTo(Gateway::class, 'payment_type_buy');
    }
    public function scopeAvailableForSell($query)
    {
        return $query->where('available_for_sell', Status::YES);
    }
    public function scopeAvailableForBuy($query)
    {
        return $query->where('available_for_buy', Status::YES);
    }
}
