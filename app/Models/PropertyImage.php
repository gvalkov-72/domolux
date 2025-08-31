<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class PropertyImage extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'property_id',
        'image_path',
        'is_active',
        'sort_order',
    ];

    public array $translatable = ['description'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
