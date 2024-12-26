<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Eloquent\UserRepository;
use App\Repository\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // menambahkan mekanisme untuk menghubungi
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}