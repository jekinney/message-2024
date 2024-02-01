<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Following/List', [
            'following' => auth()->user()->following()->paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $id, User $user)
    {
        $user->addFollowing($id);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, User $user)
    {
        $user->removeFollowing($id);

        return back();
    }
}
