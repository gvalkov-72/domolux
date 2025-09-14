<?php

// app/Models/PropertyTypeTranslation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPropertyTypeTranslation
 */
class PropertyTypeTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
