<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Gate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime:F j, Y \a\t g:i a',
    ];

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function (User $user) {
            return in_array($user->email, [
                'test@example.com',
            ]);
        });
    }

    /**
     * Undocumented function
     *
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Undocumented function
     *
     * @return HasMany
     */
    public function unlikes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Undocumented function
     *
     * @return HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Relationship to Message Model
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'author_id', 'id');
    }

    /**
     * Relationship to User Model
     * for people attached to a user
     *
     * @return BelongsToMany
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
                'followers',
                'user_id',
                'follower_id'
            )->withTimestamps();
    }

    /**
     * Relationship to the User Model
     * for a user to attach to people
     *
     * @return BelongsToMany
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
                User::class,
                'followers',
                'follower_id',
                'user_id'
            )->withTimestamps();
    }

    /**
     * Search db by a user name
     *
     * @param  Request $request
     * @return LengthAwarePaginator
     */
    public function search(User $query, Request $request): LengthAwarePaginator
    {
        // Validate we have a name variable
        $request->validate([
            'name' => 'required|string',
        ]);

        return $query->where('name', 'like', '%'.$request->name.'%')
                ->paginate($request->amount?? 10);
    }
    /**
     * A public list of users'. Will not
     * include any private or otherwise
     * users deemed unacceptable, ban,
     * deleted, etc.
     *
     * @param  Request $request
     * @return LengthAwarePaginator
     */
    public function publicList(Request $request): LengthAwarePaginator
    {
        if ( $request->has('name') ) {
            return $this->latest()
                ->where('name', 'LIKE', '%'.$request->name.'%')
                ->paginate($request->amount?? 10);
        }
        return $this->latest()->paginate($request->amount?? 10);
    }

    /**
     * A User can add a person they want to follow
     *
     * @param  int $id
     * @return boolean
     */
    public function addFollower(int $id): bool
    {
        if( $user = $this->find($id) ) {
            $user->following()->attach(auth()->user()->id);
            return true;
        }
        abort(401, 'User not found.');
    }

     /**
     * A User can add a person they want to follow
     *
     * @param  int $id
     * @return boolean
     */
    public function addFollowing(int $id): bool
    {
        if( $user = $this->find($id) ) {
            auth()->user()->following()->attach($user);
            return true;
        }
        abort(401, 'User not found.');
    }

    /**
     * A User can remove a person they are following
     *
     * @param  int $id
     * @return boolean
     */
    public function removeFollower(int $id): bool
    {
        if ( $user = $this->find($id) ) {
            return $user->following()->detach(auth()->user());
        }
        abort(401, 'User not found.');
    }

    /**
     * A User can remove a person they are following
     *
     * @param  int $id
     * @return boolean
     */
    public function removeFollowing(int $id): bool
    {
        if ( $user = $this->find($id) ) {
            return auth()->user()->following()->detach($user);
        }
        abort(401, 'User not found.');
    }

    /**
     * Get a users that our auth user
     * is following users ids' for
     * showing which users are
     * being followed.
     *
     * @return Collection|null
     */
    public function getFollowing(): Collection|null
    {
        // load a user's following users
        $following = auth()->user()->following;
        // If empty (not following any users) return null
        if ( $following->isEmpty() ) {
            return null;
        }
        // return a collection of user ids'
        return $following->pluck('id');
    }
}
