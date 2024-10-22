<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class App extends Model
{
    use HasFactory;

    protected $table = 'apps';

    protected $fillable = [
        'name',
        'version',
        'type',
    ];

    // Define the relationship to Clients (Many-to-Many)
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_apps');
    }
}