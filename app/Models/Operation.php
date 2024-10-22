<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    use HasFactory;

    protected $table = 'operations';

    protected $fillable = [
        'client_id',
        'type',
        'device_id',
        'device_total',
        'date',
    ];

    // Define the relationship to Client (Many-to-One)
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    // Define the relationship to Device (Many-to-One)
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}