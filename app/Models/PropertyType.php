<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasTranslations;

    protected $fillable = ['is_active'];

    public array $translatable = ['name'];

    public function getTranslatedAttribute($key, $locale = null)
    {
        return $this->translations
            ->where('locale', $locale ?? app()->getLocale())
            ->where('key', $key)
            ->first()?->value;
    }
}
