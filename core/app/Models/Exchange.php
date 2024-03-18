<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Constants\Status;

class Exchange extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment_from_getway()
    {
        return $this->belongsTo(Currency::class,'payment_from');
    }

    public function payment_to_getway()
    {
        return $this->belongsTo(Currency::class,'payment_to');
    }

    public function deposit(){
        return $this->hasOne(Deposit::class,'deposit_id');
    }

    public function scopeList($query)
    {
        return $query->whereIn('status', Status::EXCHANGE_ALL_STATUS);
    }
    public function scopePending($query)
    {
        return $query->where('status', Status::EXCHANGE_PENDING);
    }
    public function scopeProccess($query)
    {
        return $query->where('status', Status::EXCHANGE_PROCCESS);
    }
    public function scopeApproved($query)
    {
        return $query->where('status', Status::EXCHANGE_APPROVED);
    }
    public function scopeCanceled($query)
    {
        return $query->where('status', Status::EXCHANGE_CANCEL);
    }
    public function scopeRefunded($query)
    {
        return $query->where('status', Status::EXCHANGE_REFUND);
    }


    public function badgeData($showTime = true)
    {
        $html = '';

        if ($this->status == Status::EXCHANGE_PENDING) {
            $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
        }
        else if ($this->status == Status::EXCHANGE_PROCCESS) {
            $html = '<span class="badge badge--warning">' . trans('Proccessing') . '</span>';
        }
         elseif ($this->status == Status::EXCHANGE_APPROVED) {
            $html = '<span><span class="badge badge--success">' . trans('Approved') . '</span>';
            if ($showTime) $html;
            $html .= '</span>';
        } elseif ($this->status == Status::EXCHANGE_CANCEL) {
            $html = '<span class="badge badge--danger">' . trans('Canceled') . '</span>';
        } elseif ($this->status == Status::EXCHANGE_REFUND) {
            $html = '<span><span class="badge badge--warning">' . trans('Refunded') . '</span>';
            if ($showTime) $html;
            $html .= '</span>';
        }
        return $html;
    }
    
}
