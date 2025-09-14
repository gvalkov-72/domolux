<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

/**
 * @mixin IdeHelperSectionItem
 */
class SectionItem extends Model
{
    use HasFactory, HasTranslations;

    /**
     * Масово попълними полета
     */
    protected $fillable = [
        'section_id',
        'image',
        'url',
        'position',
        'is_active',
        'property_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Полета, които ще се превеждат (примери)
     */
    public array $translatable = [
        'title',
        'subtitle',
        'excerpt',
        'content',
        'button_text',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'is_active' => 'boolean',
        'position'  => 'integer',
    ];

    /**
     * Връзка към Section
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Връзка към Property (nullable)
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
