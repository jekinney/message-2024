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
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        return Inertia::render('Message/List', $message->remove());
    }
}
