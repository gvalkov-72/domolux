<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTranslation
 */
class Translation extends Model
{
    protected $fillable = [
        'locale', 'key', 'value',
    ];

    public function translatable()
    {
        return $this->morphTo();
    }
}
