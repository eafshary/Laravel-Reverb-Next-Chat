<?php

namespace App\Repositories\Interfaces;

interface ChatMessageRepositoryInterface extends RepositoryInterface
{
    public function getMessagesBetweenUsers($senderId, $receiverId);
    public function createMessage(array $data);
} 