<?php

namespace App\Traits;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTranslations
{
    protected array $translationsCache = [];

    /**
     * Връзка към таблицата translations
     */
    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Взимане на превод по ключ и език
     */
    public function getTranslation(string $key, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        // Кеширане в рамките на текущата заявка
        $this->translationsCache[$locale] ??= $this->translations
            ->where('locale', $locale)
            ->keyBy('key')
            ->map(fn($t) => $t->value)
            ->all();

        return $this->translationsCache[$locale][$key] ?? null;
    }

    /**
     * Създаване/актуализиране на превод
     */
    public function setTranslation(string $key, string $locale, ?string $value): void
    {
        $this->translations()->updateOrCreate(
            ['key' => $key, 'locale' => $locale],
            ['value' => $value ?? '']
        );
    }

    /**
     * Изтриване на всички преводи
     */
    public function deleteTranslations(): void
    {
        $this->translations()->delete();
    }

    /**
     * Попълване на преводи от масив
     */
    public function fillTranslations(array $input): void
    {
        foreach ($input as $locale => $fields) {
            if (!is_array($fields)) continue;

            foreach ($fields as $key => $value) {
                // 👉 тук вече не прескачаме null/празно, а го пазим като ''
                $this->setTranslation($key, $locale, $value);
            }
        }
    }

    /**
     * Взимане на преведен атрибут
     */
    public function getTranslatedAttribute(string $key): ?string
    {
        return $this->getTranslation($key);
    }

    /**
     * Връща обект с всички преведени полета за даден език
     */
    public function translate(?string $locale = null): object
    {
        $locale = $locale ?? app()->getLocale();

        $fields = [];
        foreach ($this->translatable as $key) {
            $fields[$key] = $this->getTranslation($key, $locale);
        }

        return (object) $fields;
    }
}
