<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\User;
use App\Repositories\Interfaces\ChatMessageRepositoryInterface;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    private $chatMessageRepository;

    public function __construct(ChatMessageRepositoryInterface $chatMessageRepository)
    {
        $this->chatMessageRepository = $chatMessageRepository;
    }

    public function index(User $user, Request $request)
    {
        $messages = $this->chatMessageRepository->getMessagesBetweenUsers(
            $request->user()->id,
            $user->id
        );
        return response()->json($messages);
    }

    public function store(StoreMessageRequest $request, User $user)
    {
        $message = $this->chatMessageRepository->createMessage([
            'sender_id' => $request->user()->id,
            'receiver_id' => $user->id,
            'text' => $request->message
        ]);

        broadcast(new MessageSent($message));

        return response()->json($message, 201);
    }
} 