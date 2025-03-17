<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getCurrentUser()
    {
        return $this->userRepository->getCurrentUser();
    }

    public function getAllUsersExceptCurrent($currentUserId)
    {
        return $this->userRepository->getAllExcept($currentUserId);
    }

    public function getUserById($id)
    {
        $user = $this->userRepository->find($id);
        
        if (!$user) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("User not found");
        }

        return $user;
    }
} 