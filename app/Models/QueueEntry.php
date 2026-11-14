<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'vehicle_id', 'queue_number', 'queue_date', 'queue_time', 'status'])]
class QueueEntry extends Model
{
    public const STATUSES = [
        'Menunggu',
        'Diproses',
        'Selesai',
        'Dibatalkan',
    ];

    protected function casts(): array
    {
        return [
            'queue_date' => 'date',
            'queue_time' => 'datetime:H:i',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
