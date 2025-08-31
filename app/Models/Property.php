<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Property extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'property_type_id',
        'country_id',
        'city_id',
        'district_id',
        'location_id',
        'user_id',
        'address',
        'phone',
        'email',
        'price',
        'area',
        'floor',
        'rooms',
        'cover_image',
        'is_active',
        'offer_type',   // ✅ добавено поле
    ];

    // Преводими полета
    protected array $translatable = [
        'name',
        'description',
        'offer_type', // ✅ вече е включено
    ];

    // Връзки
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'extra_property');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
