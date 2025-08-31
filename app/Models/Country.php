<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Country extends Model
{
    use HasTranslations;

    protected $fillable = [
        'code',
        'is_active',
    ];

    public $translatable = ['name'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
