<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\ShipmentHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SampleShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a user for the shipment
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }

        // Create a sample shipment
        $shipment = Shipment::create([
            'tracking_number' => 'SH65A1B2C3D4E5F',
            'status' => 'in_transit',
            'user_id' => $user->id,
            
            // Shipper Information
            'shipper_name' => 'John Smith',
            'shipper_phone' => '+1-555-0123',
            'shipper_address' => '123 Main Street, New York, NY 10001, USA',
            'shipper_email' => 'john.smith@email.com',
            
            // Receiver Information
            'receiver_name' => 'Sarah Johnson',
            'receiver_phone' => '+1-555-0456',
            'receiver_address' => '456 Oak Avenue, Los Angeles, CA 90210, USA',
            'receiver_email' => 'sarah.johnson@email.com',
            
            // Shipment Details
            'agent_name' => 'Mike Wilson',
            'type_of_shipment' => 'Documents',
            'weight' => '2.5 kg',
            'courier' => 'Express Delivery',
            'packages' => '1',
            'mode' => 'Air',
            'product' => 'Legal Documents',
            'quantity' => '1',
            
            // Payment & Freight
            'payment_mode' => 'Prepaid',
            'total_freight' => '$125.50',
            
            // Carrier Information
            'carrier' => 'FedEx',
            'carrier_reference_no' => 'FX123456789',
            
            // Timing Information
            'departure_time' => '14:30',
            'origin' => 'New York, NY',
            'destination' => 'Los Angeles, CA',
            'pickup_date' => Carbon::now()->subDays(3),
            'pickup_time' => '09:00',
            'expected_delivery_date' => Carbon::now()->addDay(),
            
            // Additional Information
            'comments' => 'Fragile documents - handle with care',
        ]);

        // Create shipment history entries
        $histories = [
            [
                'status' => 'Shipment Created',
                'location' => 'New York, NY',
                'note' => 'Shipment created and ready for pickup',
                'created_at' => Carbon::now()->subDays(3)->subHours(2),
            ],
            [
                'status' => 'Picked Up',
                'location' => 'New York, NY',
                'note' => 'Package picked up from sender',
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'status' => 'In Transit',
                'location' => 'New York Hub',
                'note' => 'Package arrived at origin hub',
                'created_at' => Carbon::now()->subDays(2)->subHours(4),
            ],
            [
                'status' => 'In Transit',
                'location' => 'Chicago Hub',
                'note' => 'Package in transit to destination',
                'created_at' => Carbon::now()->subDays(1)->subHours(8),
            ],
            [
                'status' => 'Out for Delivery',
                'location' => 'Los Angeles Hub',
                'note' => 'Package arrived at destination hub and out for delivery',
                'created_at' => Carbon::now()->subHours(2),
            ],
        ];

        foreach ($histories as $historyData) {
            ShipmentHistory::create([
                'shipment_id' => $shipment->id,
                'status' => $historyData['status'],
                'location' => $historyData['location'],
                'note' => $historyData['note'],
                'updated_by' => $user->id,
                'remarks' => 'System generated',
                'created_at' => $historyData['created_at'],
                'updated_at' => $historyData['created_at'],
            ]);
        }

        // Update shipment status to match latest history
        $shipment->update(['status' => 'out_for_delivery']);

        $this->command->info('Sample shipment created with tracking number: ' . $shipment->tracking_number);
        $this->command->info('Created ' . count($histories) . ' history entries');
    }
}
