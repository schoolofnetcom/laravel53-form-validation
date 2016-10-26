<?php

namespace App\Providers;

use Code\Validator\Cnpj;
use Code\Validator\Cpf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('documento', function ($attribute, $value, $parameters, $validator) {
            if($parameters[0] == 'cpf'){
                $documentValidator = new Cpf();
            }else{
                $documentValidator = new Cnpj();
            }
            return $documentValidator->isValid($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->singleton(\Faker\Generator::class, function () {
                return \Faker\Factory::create(env('FAKER_LANGUAGE'));
            });
        }
    }
}
