<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Milon Barcode provider
       $this->app->register(\Milon\Barcode\BarcodeServiceProvider::class);

       // Register the alias dynamically
       $loader = AliasLoader::getInstance();
       $loader->alias('DNS1D', \Milon\Barcode\Facades\DNS1DFacade::class);
       $loader->alias('DNS2D', \Milon\Barcode\Facades\DNS2DFacade::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            // Cek jika user memiliki role 'admin'
            return $user->role < 3;  // Mengizinkan hanya user dengan role 'admin'
        });

        Gate::define('petugas' , function (User $user) {
            return $user->role == 3;
        });

    }
}
