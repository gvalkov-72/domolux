<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraTranslation extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'extra_id',
        'locale',
        'name',
    ];

    public function extra()
    {
        return $this->belongsTo(Extra::class);
    }
}
