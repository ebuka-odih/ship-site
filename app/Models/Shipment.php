<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'status',
        
        // Shipper Information
        'shipper_name',
        'shipper_phone',
        'shipper_address',
        'shipper_email',
        
        // Receiver Information
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'receiver_email',
        
        // Shipment Details
        'agent_name',
        'type_of_shipment',
        'weight',
        'courier',
        'packages',
        'mode',
        'product',
        'quantity',
        
        // Payment & Freight
        'payment_mode',
        'total_freight',
        
        // Carrier Information
        'carrier',
        'carrier_reference_no',
        
        // Timing Information
        'departure_time',
        'origin',
        'destination',
        'pickup_date',
        'pickup_time',
        'expected_delivery_date',
        
        // Additional Information
        'comments',
        'tracking_events',
        'user_id',
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'expected_delivery_date' => 'date',
        'departure_time' => 'datetime:H:i',
        'pickup_time' => 'datetime:H:i',
        'tracking_events' => 'array',
    ];

    /**
     * Get the user that owns the shipment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shipment history records.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(ShipmentHistory::class);
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'in_transit' => 'blue',
            'delivered' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    /**
     * Get the status badge variant.
     */
    public function getStatusBadgeVariantAttribute(): string
    {
        return match($this->status) {
            'pending' => 'secondary',
            'in_transit' => 'default',
            'delivered' => 'default',
            'cancelled' => 'destructive',
            default => 'outline',
        };
    }

    /**
     * Generate a unique tracking number.
     */
    public static function generateTrackingNumber(): string
    {
        do {
            $trackingNumber = 'SH' . strtoupper(uniqid());
        } while (self::where('tracking_number', $trackingNumber)->exists());

        return $trackingNumber;
    }

    /**
     * Add a tracking event.
     */
    public function addTrackingEvent(string $status, string $description, ?string $location = null): void
    {
        $events = $this->tracking_events ?? [];
        $events[] = [
            'status' => $status,
            'description' => $description,
            'location' => $location,
            'timestamp' => now()->toISOString(),
        ];
        
        $this->update([
            'tracking_events' => $events,
            'status' => $status,
        ]);
    }
}
