<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAllExcept($userId);
    public function getCurrentUser();
} 