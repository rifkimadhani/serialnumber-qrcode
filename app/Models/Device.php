<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';

    protected $fillable = [
        'name',
        'model',
        'stock',
    ];

    // Define the relationship to Clients (Many-to-Many)
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_devices');
    }
}