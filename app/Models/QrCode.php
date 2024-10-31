<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qr_codes';

    protected $fillable = [
        'serial_number',
        'model_number',
        'qr_code',
        'client_id',
        'device_id',  // Add the device_id field to fillable
    ];

    // Define the relationship to the Client
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    // Define the relationship to the Device
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     // When a QrCode is created
    //     static::created(function ($qrCode) {
    //         if ($qrCode->client_id) {
    //             Client::where('id', $qrCode->client_id)
    //                 ->increment('total_devices'); // Increment total_devices by 1
    //         }
    //     });

    //     // When a QrCode is deleted
    //     static::deleted(function ($qrCode) {
    //         if ($qrCode->client_id) {
    //             Client::where('id', $qrCode->client_id)
    //                 ->decrement('total_devices'); // Decrement total_devices by 1
    //         }
    //     });
    // }

    // public static function updateClientId($qrCodeId, $newClientId)
    // {
    //     $qrCode = self::find($qrCodeId);

    //     // Get the old client ID to update the total_devices correctly
    //     $oldClientId = $qrCode->client_id;

    //     // Update the client_id
    //     $qrCode->client_id = $newClientId;
    //     $qrCode->save();

    //     // Update total_devices for the old client
    //     if ($oldClientId) {
    //         Client::where('id', $oldClientId)->decrement('total_devices');
    //     }

    //     // Update total_devices for the new client
    //     if ($newClientId) {
    //         Client::where('id', $newClientId)->increment('total_devices');
    //     }
    // }
}
