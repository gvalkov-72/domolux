<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'code',
        'name',
        'is_active',
        'is_default_admin',
        'is_default_site',
        'description',
        'position',
    ];

    /**
     * Scope a query to only include active languages.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
