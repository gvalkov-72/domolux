<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
{
    $this->registerPolicies();

    // Зареждане на всички пермишъни от базата
    try {
        Permission::all()->each(function ($permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission->name);
            });
        });
    } catch (\Exception $e) {
        // Например ако таблицата все още не съществува при миграция
        report($e);
    }
}
}
