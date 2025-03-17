<?php

namespace App\Repositories\Eloquent;

use App\Models\ChatMessage;
use App\Repositories\Interfaces\ChatMessageRepositoryInterface;

class ChatMessageRepository extends BaseRepository implements ChatMessageRepositoryInterface
{
    public function __construct(ChatMessage $model)
    {
        parent::__construct($model);
    }

    public function getMessagesBetweenUsers($senderId, $receiverId)
    {
        return $this->model->query()
            ->where(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $senderId)
                    ->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $senderId);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('id', 'asc')
            ->get();
    }

    public function createMessage(array $data)
    {
        return $this->create($data);
    }
} 