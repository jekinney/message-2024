<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $user)
    {
        return Inertia::render('Followers/List', [
            'followers' => $user->getFollowersList($request)
        ]);
    }

    public function store(Request $request, User $user)
    {
        $user->attachFollower($request);

        return redirect()->route('followers');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $user->removeFollower($request);

        return redirect()->route('followers');
    }
}
