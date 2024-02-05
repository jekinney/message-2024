<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unlike extends Model
{
    use HasFactory;

    /**
     * Guarded columns from mass assignment
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the parent likeable model (post or video).
     *
     * @return MorphTo
     */
    public function unlikable(): MorphTo
    {
        return $this->morphTo();
    }
}
