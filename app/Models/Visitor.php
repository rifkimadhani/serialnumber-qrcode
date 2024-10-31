<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'user_agent', 'referrer', 'page_url', 'visited_at'];

    // Optionally, you may add timestamps if needed
    public $timestamps = true; // this is true by default
}