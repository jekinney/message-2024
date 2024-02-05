<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Message $message)
    {
        return Inertia::render('Message/List', [
            'messages' => $message->feed($request)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Message $message)
    {
        $message->store($request);

        return response()->redirect('messages');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        return Inertia::render('Message/List', $message->renew($request));
    }

    /**
     * Remove a message
     *
     * @param  Message $message
     * @return void
     */
    public function destroy(Message $message)
    {
        return Inertia::render('Message/List', $message->remove());
    }

    /**
     * Undocumented function
     *
     * @param Message $message
     * @return void
     */
    public function like(Request $request, Message $message)
    {
        $message->addLike();

        return $message->feed($request)->toJson();
    }

    /**
     * Undocumented function
     *
     * @param Message $message
     * @return void
     */
    public function unlike(Message $message)
    {
        $message->addUnlike();

        return response()->redirect('messages');
    }

    /**
     * Undocumented function
     *
     * @param Message $message
     * @return void
     */
    public function report(Message $message)
    {
        $message->addReport();

        return response()->redirect('messages');
    }
}
