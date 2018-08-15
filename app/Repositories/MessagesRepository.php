<?php

namespace App\Repositories;

use App\Message;
use App\Contracts\MessagesInterface;

class MessagesRepository extends Repository implements MessagesInterface
{
    /**
     * Create new instance of messages repository.
     *
     * @param Category $messages Message repository.
     */
    public function __construct(Message $messages)
    {
        parent::__construct($messages);
        $this->messages = $messages;
    }
}
