<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperLocation
 */
class Location extends Model
{
    use HasTranslations;

    protected $fillable = ['district_id', 'is_active'];
    public array $translatable = ['name'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function getTranslatedAttribute($key, $locale = null)
    {
        return $this->translations
            ->where('locale', $locale ?? app()->getLocale())
            ->where('key', $key)
            ->first()?->value;
    }
}
