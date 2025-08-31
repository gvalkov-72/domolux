<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExtraProperty extends Pivot
{
    protected $table = 'extra_property';

    protected $fillable = [
        'property_id',
        'extra_id'
    ];

    public $timestamps = false;
}
