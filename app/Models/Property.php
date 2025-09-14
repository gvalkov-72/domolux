<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

/**
 * @mixin IdeHelperProperty
 */
class Property extends Model
{
    use HasTranslations;

    protected $fillable = [
        'code',
        'position',
        'price_bgn',
        'price_eur',
        'user_id',
        'is_active',
        'active_from',
        'active_until',
    ];

    // преводими полета
    public array $translatable = [
        'title',
        'description',
    ];

    // връзки
    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class, 'property_property_type');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_property');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_property');
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'district_property');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_property');
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'property_extra');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // помощно: вземане на cover image
    public function coverImage()
    {
        return $this->images()->where('is_cover', true)->first();
    }
}
