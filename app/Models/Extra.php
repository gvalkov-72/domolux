<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

/**
 * @mixin IdeHelperExtra
 */
class Extra extends Model
{
    use HasTranslations;

    protected $fillable = [
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Връзка с преводите е реализирана чрез HasTranslations trait

    // Помощна функция за достъп до превода на 'name'
    public function getNameAttribute()
    {
        return $this->getTranslatedAttribute('name');
    }

    // Помощна функция за достъп до превода на 'description'
    public function getDescriptionAttribute()
    {
        return $this->getTranslatedAttribute('description');
    }
}
