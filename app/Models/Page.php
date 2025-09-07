<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    /**
     * Полета, които могат да се попълват масово
     */
    protected $fillable = [
        'slug',
        'seo_title',
        'seo_description',
        'meta_keywords',
        'template',
        'parent_id',
        'author_id',
        'published_at',
        'is_active',
        'sort_order',
        'created_by',
        'updated_by',
    ];

    /**
     * Преводими полета (централизирана таблица translations)
     */
    public array $translatable = [
        'title',      // Заглавие на страницата
        'content',    // Съдържание (HTML, WYSIWYG)
        'excerpt',    // Кратко описание
    ];

    /**
     * Кастове
     */
    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Връзка с родителска страница (ако има йерархия)
     */
    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Връзка с подстраници
     */
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    /**
     * Връзка с автора (ако има потребители)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Връзка кой е създал
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Връзка кой е редактирал
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
