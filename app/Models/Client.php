<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'project',
        'address',
        'status',
        'country',
        'pic_name',
        'pic_contact',
        'notes',
    ];

    // relationship to QrCode
    public function qrCodes(): HasMany
    {
        return $this->hasMany(QrCode::class);
    }

    // relationship to Devices (Many-to-Many)
    public function devices(): BelongsToMany
    {
        return $this->belongsToMany(Device::class, 'client_devices');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'client_categories');
    }

    // relationship to Apps (Many-to-Many)
    public function apps(): BelongsToMany
    {
        return $this->belongsToMany(App::class, 'client_apps');
    }

    // relationship to Operations (One-to-Many)
    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    public function deliveredDevicesTotal()
    {
        return $this->hasMany(Operation::class)
                    ->where('type', 'deliver')
                    ->sum('device_total');
    }

    public function totalDevicesPerDevice()
    {
        // fetch all operations grouped by device_id
        $deviceTotals = $this->operations()
                             ->selectRaw('device_id,
                                          SUM(CASE WHEN type = "deliver" THEN device_total ELSE 0 END) as total_delivered,
                                          SUM(CASE WHEN type = "returns" THEN device_total ELSE 0 END) as total_returned')
                             ->groupBy('device_id')
                             ->get();

        $deviceSummary = [];

        // loop through each device's operations
        foreach ($deviceTotals as $operation) {
            $device = $operation->device; // Fetch the device name
            $totalDelivered = $operation->total_delivered;
            $totalReturned = $operation->total_returned;

            // net total
            $netTotal = $totalDelivered - $totalReturned;

            // avoid negative totals
            // $deviceSummary[$device->name] = max($netTotal, 0);
            $deviceSummary[$device->id] = [
                'name' => $device->name,
                'model' => $device->model,
                'total' => max($netTotal, 0)
            ];
        }

        return $deviceSummary;
    }

    public function totalDevices()
    {
        $totalDelivered = $this->operations()
                               ->where('type', 'deliver')
                               ->sum('device_total');

        $totalReturned = $this->operations()
                              ->where('type', 'returns')
                              ->sum('device_total');

        $total = $totalDelivered - $totalReturned;

        if ($total < 0){
            return 0;
        } else {
            return strval($total);
        }
    }
}
