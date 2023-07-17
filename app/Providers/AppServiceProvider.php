<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'Book' => \App\Models\Book::class,
            'ElectronicMedia' => \App\Models\ElectronicMedia::class,
            'Magazine' => \App\Models\Magazine::class,
        ]);
    }
}
