<?php

namespace App\Providers;

use App\Contracts\UserModelInterface;
use App\Contracts\UserTokenModelInterface;
use App\Repository\UserRepository;
use App\Repository\UserTokenRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /** @var array  */
    private $models = [
        UserTokenModelInterface::class => UserTokenRepository::class,
        UserModelInterface::class => UserRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->models as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
