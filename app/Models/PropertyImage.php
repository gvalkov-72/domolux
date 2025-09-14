<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperPropertyImage
 */
class PropertyImage extends Model
{
    protected $fillable = [
        'property_id',
        'path',
        'disk',
        'position',
        'is_cover',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // достъп до пълния URL
    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }
}
