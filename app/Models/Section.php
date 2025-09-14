<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

/**
 * @mixin IdeHelperSection
 */
class Section extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'type',
        'key',
        'position',
        'is_active',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings'  => 'array',
    ];

    /**
     * Полета, които подлежат на превод
     */
    public array $translatable = [
        'title',
        'excerpt',
        'content',
    ];

    /**
     * Връзка: секция има много елементи
     */
    public function items()
    {
        return $this->hasMany(SectionItem::class)->orderBy('position');
    }
}
