<?php

namespace App\Traits;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTranslations
{
    protected array $translationsCache = [];

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

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

    public function setTranslation(string $key, string $locale, string $value): void
    {
        $this->translations()->updateOrCreate(
            ['key' => $key, 'locale' => $locale],
            ['value' => $value]
        );
    }

    public function deleteTranslations(): void
    {
        $this->translations()->delete();
    }

    public function fillTranslations(array $input): void
    {
        foreach ($input as $locale => $fields) {
            if (!is_array($fields)) continue;

            foreach ($fields as $key => $value) {
                if (is_null($value) || $value === '') continue; // Пропускаме празни
                $this->setTranslation($key, $locale, $value);
            }
        }
    }

    public function getTranslatedAttribute(string $key): ?string
    {
        return $this->getTranslation($key);
    }
}
