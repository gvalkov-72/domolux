<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperDistrict
 */
class District extends Model
{
    use HasTranslations;

    protected $fillable = ['city_id', 'is_active'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getTranslatedAttribute($key, $locale = null)
    {
        return $this->translations
            ->where('locale', $locale ?? app()->getLocale())
            ->where('key', $key)
            ->first()?->value;
    }

    public array $translatable = ['name'];
}
