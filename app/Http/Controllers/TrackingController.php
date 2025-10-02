<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    /**
     * Display the tracking page
     */
    public function index(Request $request)
    {
        $trackingNumber = $request->get('tracking_number');
        $trackingData = null;
        
        if ($trackingNumber) {
            $trackingData = $this->getTrackingData($trackingNumber);
        }
        
        return view('pages.track', compact('trackingNumber', 'trackingData'));
    }
    
    /**
     * Get tracking data for a given tracking number
     */
    private function getTrackingData($trackingNumber)
    {
        // Sample tracking data - in a real application, this would come from your database
        $sampleData = [
            'wpcargo-123' => [
                'tracking_number' => 'WPCARGO-123',
                'status' => 'In Transit',
                'shipper' => [
                    'name' => 'Peter John Villanueva',
                    'phone' => '639269901717',
                    'address' => 'CPU Centennial Village Aganan, Pavia, Iloilo, 5001, Philippines',
                    'email' => 'villanuevapj17@gmail.com'
                ],
                'receiver' => [
                    'name' => 'John Smith',
                    'phone' => '9876543210',
                    'address' => 'Building 3 Floor 4 123 Main Street Salt Lake City',
                    'email' => 'rgmadredano@woosteps.com'
                ],
                'shipment_details' => [
                    'mode' => 'Mode 2',
                    'type_of_shipment' => 'Shipment 3',
                    'courier' => 'Courier 1',
                    'packages' => 'Package 101',
                    'quantity' => '150 box',
                    'payment_mode' => 'Stripe',
                    'carrier' => 'Carrier Name',
                    'carrier_reference_no' => 'REF123456',
                    'weight' => '400kg',
                    'product' => 'Product 20301',
                    'total_freight' => '$20,000',
                    'departure_time' => '2024-01-15 10:30 AM'
                ],
                'tracking_history' => [
                    [
                        'date' => '2024-01-15 10:30 AM',
                        'status' => 'Package picked up',
                        'location' => 'Pavia, Iloilo, Philippines'
                    ],
                    [
                        'date' => '2024-01-15 2:45 PM',
                        'status' => 'In transit to sorting facility',
                        'location' => 'Iloilo City, Philippines'
                    ],
                    [
                        'date' => '2024-01-16 8:20 AM',
                        'status' => 'Arrived at sorting facility',
                        'location' => 'Manila, Philippines'
                    ],
                    [
                        'date' => '2024-01-16 3:15 PM',
                        'status' => 'Departed from sorting facility',
                        'location' => 'Manila, Philippines'
                    ]
                ]
            ],
            'wpcargo-456' => [
                'tracking_number' => 'WPCARGO-456',
                'status' => 'Delivered',
                'shipper' => [
                    'name' => 'Maria Garcia',
                    'phone' => '639123456789',
                    'address' => '123 Business District, Makati City, Philippines',
                    'email' => 'maria.garcia@email.com'
                ],
                'receiver' => [
                    'name' => 'David Johnson',
                    'phone' => '1234567890',
                    'address' => '456 Oak Street, New York, NY 10001',
                    'email' => 'david.johnson@email.com'
                ],
                'shipment_details' => [
                    'mode' => 'Mode 1',
                    'type_of_shipment' => 'Express Delivery',
                    'courier' => 'Express Courier',
                    'packages' => 'Package 202',
                    'quantity' => '25 items',
                    'payment_mode' => 'Credit Card',
                    'carrier' => 'Express Logistics',
                    'carrier_reference_no' => 'EXP789012',
                    'weight' => '15kg',
                    'product' => 'Electronics',
                    'total_freight' => '$1,500',
                    'departure_time' => '2024-01-10 9:00 AM'
                ],
                'tracking_history' => [
                    [
                        'date' => '2024-01-10 9:00 AM',
                        'status' => 'Package picked up',
                        'location' => 'Makati City, Philippines'
                    ],
                    [
                        'date' => '2024-01-10 11:30 AM',
                        'status' => 'In transit',
                        'location' => 'Manila Airport, Philippines'
                    ],
                    [
                        'date' => '2024-01-11 2:15 PM',
                        'status' => 'Arrived at destination country',
                        'location' => 'New York, USA'
                    ],
                    [
                        'date' => '2024-01-12 10:45 AM',
                        'status' => 'Out for delivery',
                        'location' => 'New York, USA'
                    ],
                    [
                        'date' => '2024-01-12 3:20 PM',
                        'status' => 'Delivered',
                        'location' => 'New York, USA'
                    ]
                ]
            ]
        ];
        
        // Return data if tracking number exists, otherwise return null
        return $sampleData[strtolower($trackingNumber)] ?? null;
    }
    
    /**
     * Search for tracking number (AJAX endpoint)
     */
    public function search(Request $request)
    {
        $trackingNumber = $request->get('tracking_number');
        
        if (!$trackingNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a tracking number'
            ]);
        }
        
        $trackingData = $this->getTrackingData($trackingNumber);
        
        if ($trackingData) {
            return response()->json([
                'success' => true,
                'data' => $trackingData
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tracking number not found. Please check your tracking number and try again.'
            ]);
        }
    }
}
