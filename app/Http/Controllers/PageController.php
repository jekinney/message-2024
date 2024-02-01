<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        return Inertia::render('Home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dashboard(Request $request)
    {
        $messages = auth()->user()->messages;

        return Inertia::render('Dashboard', ['messages' => $messages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
