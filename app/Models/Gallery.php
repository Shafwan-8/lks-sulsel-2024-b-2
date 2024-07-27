<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'name',
        'user_id',
        'description'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
