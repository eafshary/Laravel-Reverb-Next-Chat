<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function currentUser()
    {
        return response()->json($this->userService->getCurrentUser());
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAllUsersExceptCurrent($request->user()->id);
        return response()->json($users);
    }

    public function show($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            return response()->json($user);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
} 