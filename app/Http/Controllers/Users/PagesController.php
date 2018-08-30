<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\MessagesInterface;
//use App\Mail\SendMessage;

class PagesController extends Controller
{
    protected $messages;

    public function __construct(MessagesInterface $messages)
    {
        $this->messages = $messages;
    }
    public function index()
    {
        return view('users.index');
    }

    public function contactUs()
    {
        return view('users.contact-us');
    }

    public function aboutUs()
    {
        return view('users.about-us');
    }

    public function instructions()
    {
        if (empty(session('agreed'))) {

            session()->put('agreed','yes');
            return view('users.instructions');
        }
        return redirect()->route('shop');
    }

    public function send(Request $request)
    {
        //validate all fields
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:messages',
            'subject' => 'max:255',
            'message' => 'required'
        ]);

        // If validation passed add the message.
        $this->messages->store(request());

        // After addding the message, redirect to contact us page with a success message.
        return redirect()->route('contact-us')->with('message', 'Message successfully sent');

      //  \Mail::to('ryanpgarde@gmail.com')->send($contact);
    }
}
