<?php

namespace App\Services;

use App\Events\MessageSent;
use App\Repositories\Interfaces\ChatMessageRepositoryInterface;

class ChatMessageService
{
    private $chatMessageRepository;

    public function __construct(ChatMessageRepositoryInterface $chatMessageRepository)
    {
        $this->chatMessageRepository = $chatMessageRepository;
    }

    public function getMessagesBetweenUsers($senderId, $receiverId)
    {
        return $this->chatMessageRepository->getMessagesBetweenUsers($senderId, $receiverId);
    }

    public function sendMessage($senderId, $receiverId, $messageText)
    {
        $message = $this->chatMessageRepository->createMessage([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'text' => $messageText
        ]);

        // Broadcast the message event
        broadcast(new MessageSent($message));

        return $message;
    }
} 