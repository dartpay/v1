<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Form extends Model
{
    public $casts = [
        'form_data'=>'object'
    ];

    public function set($attributes)
    {
        return [
           'type' => $attributes->type,
           'is_required' => $attributes->is_required,
           'label' => $attributes->label,
           'extensions' => $attributes->extensions,
           'options' => json_encode($attributes->options),
           'old_id' => $attributes->old_id,
        ];
        
    }
}
