<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Contracts\MessagesInterface;

class MessagesController extends Controller
{
    /**
     * Message object.
     *
     * @var App\Contracts\MessagesInterface
     */
    protected $messages;

    /**
     * Create new instance of messages controller.
     *
     * @param CategoryInterface $messages Message interface
     */
    public function __construct(MessagesInterface $messages)
    {
        $this->messages = $messages;
    }

    /**
     * Display a list of all messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->messages->all();
        return view('admins.messages.index',compact('messages'));
    }

    /**
     * Display a single message.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = $this->messages->findOrFail($id);
        return view('admins.messages.show',compact('message'));
    }
}
