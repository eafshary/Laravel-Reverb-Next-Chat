<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function currentUser()
    {
        return response()->json($this->userRepository->getCurrentUser());
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getAllExcept($request->user()->id);
        return response()->json($users);
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);
        return response()->json($user);
    }
} 