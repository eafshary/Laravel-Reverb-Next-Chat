<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\User;
use App\Services\ChatMessageService;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    private $chatMessageService;

    public function __construct(ChatMessageService $chatMessageService)
    {
        $this->chatMessageService = $chatMessageService;
    }

    public function index(User $user, Request $request)
    {
        $messages = $this->chatMessageService->getMessagesBetweenUsers(
            $request->user()->id,
            $user->id
        );
        return response()->json($messages);
    }

    public function store(StoreMessageRequest $request, User $user)
    {
        $message = $this->chatMessageService->sendMessage(
            $request->user()->id,
            $user->id,
            $request->message
        );

        return response()->json($message, 201);
    }
} 