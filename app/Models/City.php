<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasTranslations;

    protected $fillable = [
        'country_id',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function getTranslationTable(): string
    {
        return 'translations';
    }

    public function translationAttributes(): array
    {
        return ['name'];
    }
}
