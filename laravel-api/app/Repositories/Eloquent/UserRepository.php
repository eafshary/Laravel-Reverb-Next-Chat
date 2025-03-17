<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllExcept($userId)
    {
        return $this->model->whereNot('id', $userId)->get();
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }
} 