<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register(){
        // $this->app::bind(
        //       'App\Repositories\User\UserRepositoryInterface',
        //       'App\Repositories\User\UserRepository');

        // Binding another repository if has multiple repository
        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );

        //Another approach of binding repository
//           $this->app->bind(
//             UserRepositoryInterface::class,
//             UserRepository::class
//         );

    }
}