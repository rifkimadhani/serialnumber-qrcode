<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDevice extends Model
{
    use HasFactory;

    protected $table = 'client_devices';

    protected $fillable = [
        'client_id',
        'device_id',
    ];
}