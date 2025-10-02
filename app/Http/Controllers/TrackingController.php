<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\ShipmentHistory;
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
        // Find the shipment by tracking number
        $shipment = Shipment::where('tracking_number', $trackingNumber)->first();
        
        if (!$shipment) {
            return null;
        }
        
        // Format the tracking data for display
        return [
            'tracking_number' => $shipment->tracking_number,
            'status' => ucfirst(str_replace('_', ' ', $shipment->status)),
            'shipper' => [
                'name' => $shipment->shipper_name,
                'phone' => $shipment->shipper_phone,
                'address' => $shipment->shipper_address,
                'email' => $shipment->shipper_email
            ],
            'receiver' => [
                'name' => $shipment->receiver_name,
                'phone' => $shipment->receiver_phone,
                'address' => $shipment->receiver_address,
                'email' => $shipment->receiver_email
            ],
            'shipment_details' => [
                'mode' => $shipment->mode ?? 'N/A',
                'type_of_shipment' => $shipment->type_of_shipment ?? 'N/A',
                'courier' => $shipment->courier ?? 'N/A',
                'packages' => $shipment->packages ?? 'N/A',
                'quantity' => $shipment->quantity ?? 'N/A',
                'payment_mode' => $shipment->payment_mode ?? 'N/A',
                'carrier' => $shipment->carrier ?? 'N/A',
                'carrier_reference_no' => $shipment->carrier_reference_no ?? 'N/A',
                'weight' => $shipment->weight ?? 'N/A',
                'product' => $shipment->product ?? 'N/A',
                'total_freight' => $shipment->total_freight ?? 'N/A',
                'departure_time' => $shipment->departure_time ? $shipment->departure_time->format('Y-m-d H:i A') : 'N/A'
            ],
            'tracking_history' => $this->getTrackingHistory($shipment)
        ];
    }
    
    /**
     * Get tracking history for a shipment
     */
    private function getTrackingHistory($shipment)
    {
        $history = [];
        
        // Get real history from database
        $shipmentHistories = $shipment->histories()->orderBy('created_at', 'desc')->get();
        
        if ($shipmentHistories->count() > 0) {
            // Use real history from database
            foreach ($shipmentHistories as $historyItem) {
                $history[] = [
                    'date' => $historyItem->created_at->format('Y-m-d H:i A'),
                    'status' => $historyItem->status,
                    'location' => $historyItem->location ?? 'N/A'
                ];
            }
        } else {
            // If no history exists, show only the initial creation
            $history[] = [
                'date' => $shipment->created_at->format('Y-m-d H:i A'),
                'status' => 'Shipment created',
                'location' => $shipment->origin ?? 'Origin'
            ];
        }
        
        return $history;
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
