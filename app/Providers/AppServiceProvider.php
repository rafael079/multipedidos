<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        /** 
         * Linha adicionado para corrigir um problema do tamanho de carácteres da versão do MySQL usada 
         * https://laravel-news.com/laravel-5-4-key-too-long-error
         **/
        Schema::defaultStringLength(191);
    }
}
