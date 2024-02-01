<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Message extends Model
{
    use HasFactory;

    /**
     * Always eager load a relationship
     *
     * @var array
     */
    protected $with = ['author'];

    /**
     * Specify a table column casting and format
     *
     * @var array
     */
    protected $casts = [
        'body' => 'json',
        'created_at' => 'datetime:F j, Y \a\t g:i a',
    ];

    /**
     * Guarded columns from mass assignment
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Relationship to User model for Author of a Message
     *
     * @return BelongsToMany
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id')->select('id', 'name');
    }

    /**
     * Gather a user's feed or messages.
     * Should order by created at date
     * and include followed users too.
     *
     * @param  Request $request
     * @return LengthAwarePaginator
     */
    public function feed(Request $request): LengthAwarePaginator
    {
        return $this->whereIn('author_id',
                $request->user()->followers->pluck('id')->merge($request->user()->id)->toArray()
            )->latest()
            ->paginate($request->amount?? 10);
    }

    /**
     * Store a new Message
     *
     * @param  Request $request
     * @return LengthAwarePaginator
     */
    public function store(Request $request): LengthAwarePaginator
    {
        $this->validate($request);

        $this->create([
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);

        return $this->feed($request);
    }

    /**
     * Update an existing message
     *
     * @param  Request $request
     * @return LengthAwarePaginator
     */
    public function renew(Request $request): LengthAwarePaginator
    {
        $this->validate($request);

        $this->update(['body' => $request->body]);

        return $this->feed($request);
    }

    /**
     * Validate incoming request from a user
     *
     * @param  Request $request
     * @return Request
     */
    protected function validate(Request $request): Request
    {
        $request->validate(['body' => 'required|between:3,3000|string']);

        return $request;
    }
}
