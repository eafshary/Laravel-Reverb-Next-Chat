<?php

namespace App\Providers;

use App\Repositories\Eloquent\ChatMessageRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\ChatMessageRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ChatMessageRepositoryInterface::class, ChatMessageRepository::class);
    }

    public function boot()
    {
        //
    }
} 