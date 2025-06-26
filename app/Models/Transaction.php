<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'pricing_id',
        'booking_trx_id',
        'proof',
        'payment_type',
        'sub_total_amount',
        'grand_total_amount',
        'total_tax_amount',
        'is_paid',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pricing(): BelongsTo
    {
        return $this->belongsTo(Pricing::class, 'pricing_id');
    }
}
