<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
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

    public function publicList(Request $request): LengthAwarePaginator
    {
        return $this->latest()->paginate($request->amount?? 10);
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

    public function getFollowing()
    {
        $following = auth()->user()->following;

        if ( $following->isEmpty() ) {
            return null;
        }
        return $following->pluck('id');
    }
}
