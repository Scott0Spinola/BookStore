<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'sale_date',
    ];

    protected $casts = [
        'sale_date' => 'datetime',
    ];

    /**
     * Get the user who made the purchase.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that was purchased.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
