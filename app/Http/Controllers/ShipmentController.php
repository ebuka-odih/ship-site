<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shipment;
use App\Models\ShipmentHistory;
use App\Mail\ShipmentCreatedMail;
use App\Mail\ShipmentHistoryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ShipmentController extends Controller
{
    /**
     * Display a listing of shipments
     */
    public function index()
    {
        $shipments = Shipment::with('user')
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Shipments/Index', [
            'shipments' => $shipments,
        ]);
    }

    /**
     * Show the form for creating a new shipment
     */
    public function create()
    {
        return Inertia::render('Admin/Shipments/Create');
    }

    /**
     * Store a newly created shipment
     */
    public function store(Request $request)
    {
        $request->validate([
            // Shipper Information
            'shipper_name' => 'required|string|max:255',
            'shipper_phone' => 'required|string|max:20',
            'shipper_address' => 'required|string',
            'shipper_email' => 'required|email|max:255',
            
            // Receiver Information
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'receiver_address' => 'required|string',
            'receiver_email' => 'required|email|max:255',
            
            // Shipment Details
            'agent_name' => 'nullable|string|max:255',
            'type_of_shipment' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'courier' => 'nullable|string|max:255',
            'packages' => 'nullable|string|max:255',
            'mode' => 'nullable|string|max:255',
            'product' => 'nullable|string|max:255',
            'quantity' => 'nullable|string|max:255',
            
            // Payment & Freight
            'payment_mode' => 'nullable|string|max:255',
            'total_freight' => 'nullable|string|max:255',
            
            // Carrier Information
            'carrier' => 'nullable|string|max:255',
            'carrier_reference_no' => 'nullable|string|max:255',
            
            // Timing Information
            'departure_time' => 'nullable|date_format:H:i',
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable|date_format:H:i',
            'expected_delivery_date' => 'nullable|date',
            
            // Additional Information
            'comments' => 'nullable|string',
        ]);

        $shipment = Shipment::create([
            'tracking_number' => Shipment::generateTrackingNumber(),
            'status' => 'pending',
            'user_id' => 1, // Default to first user or admin
            
            // Shipper Information
            'shipper_name' => $request->shipper_name,
            'shipper_phone' => $request->shipper_phone,
            'shipper_address' => $request->shipper_address,
            'shipper_email' => $request->shipper_email,
            
            // Receiver Information
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_address' => $request->receiver_address,
            'receiver_email' => $request->receiver_email,
            
            // Shipment Details
            'agent_name' => $request->agent_name,
            'type_of_shipment' => $request->type_of_shipment,
            'weight' => $request->weight,
            'courier' => $request->courier,
            'packages' => $request->packages,
            'mode' => $request->mode,
            'product' => $request->product,
            'quantity' => $request->quantity,
            
            // Payment & Freight
            'payment_mode' => $request->payment_mode,
            'total_freight' => $request->total_freight,
            
            // Carrier Information
            'carrier' => $request->carrier,
            'carrier_reference_no' => $request->carrier_reference_no,
            
            // Timing Information
            'departure_time' => $request->departure_time,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'expected_delivery_date' => $request->expected_delivery_date,
            
            // Additional Information
            'comments' => $request->comments,
        ]);

        // Add initial tracking event
        $shipment->addTrackingEvent('pending', 'Shipment created and pending pickup');
        
        // Send email notification to receiver
        try {
            Mail::to($shipment->receiver_email)->send(new ShipmentCreatedMail($shipment));
        } catch (\Exception $e) {
            // Log error but don't fail the shipment creation
            \Log::error('Failed to send shipment created email: ' . $e->getMessage());
        }

        return redirect()->route('admin.shipments.index')
            ->with('success', 'Shipment created successfully.');
    }

    /**
     * Display the specified shipment
     */
    public function show(Shipment $shipment)
    {
        $shipment->load(['user', 'histories' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        
        return Inertia::render('Admin/Shipments/Show', [
            'shipment' => $shipment,
        ]);
    }

    /**
     * Show the form for editing the specified shipment
     */
    public function edit(Shipment $shipment)
    {
        $users = User::where('role', 'user')->get(['id', 'name', 'email']);
        
        return Inertia::render('Admin/Shipments/Edit', [
            'shipment' => $shipment,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified shipment
     */
    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,in_transit,delivered,cancelled',
            'origin_address' => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'recipient_email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0',
            'value' => 'nullable|numeric|min:0',
            'carrier' => 'nullable|string|max:255',
            'service_type' => 'nullable|string|max:255',
            'estimated_delivery' => 'nullable|date',
            'actual_delivery' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $shipment->update($request->all());

        return redirect()->route('admin.shipments.index')
            ->with('success', 'Shipment updated successfully.');
    }

    /**
     * Remove the specified shipment
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()->route('admin.shipments.index')
            ->with('success', 'Shipment deleted successfully.');
    }

    /**
     * Add tracking event to shipment
     */
    public function addTrackingEvent(Request $request, Shipment $shipment)
    {
        $request->validate([
            'status' => 'required|in:pending,in_transit,delivered,cancelled',
            'description' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $shipment->addTrackingEvent(
            $request->status,
            $request->description,
            $request->location
        );

        return redirect()->route('admin.shipments.show', $shipment)
            ->with('success', 'Tracking event added successfully.');
    }

    /**
     * Store a new shipment history entry
     */
    public function storeHistory(Request $request, Shipment $shipment)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'updated_by' => 'nullable|string|max:255',
            'created_date' => 'nullable|date',
            'created_time' => 'nullable|date_format:H:i',
        ]);

        $history = ShipmentHistory::create([
            'shipment_id' => $shipment->id,
            'status' => $request->status,
            'location' => $request->location,
            'note' => $request->note,
            'updated_by' => $request->updated_by,
            'remarks' => $request->remarks,
        ]);

        // Update created_at if custom date/time provided
        if ($request->created_date && $request->created_time) {
            $customDateTime = $request->created_date . ' ' . $request->created_time;
            $history->update(['created_at' => $customDateTime]);
        }

        // Update the shipment status if it's different
        if ($shipment->status !== $request->status) {
            $shipment->update(['status' => $request->status]);
        }
        
        // Send email notification to receiver
        try {
            Mail::to($shipment->receiver_email)->send(new ShipmentHistoryMail($shipment, $history));
        } catch (\Exception $e) {
            // Log error but don't fail the history creation
            \Log::error('Failed to send shipment history email: ' . $e->getMessage());
        }

        return redirect()->route('admin.shipments.show', $shipment)
            ->with('success', 'Shipment history added successfully.');
    }

    /**
     * Delete a shipment history entry
     */
    public function destroyHistory(Shipment $shipment, ShipmentHistory $history)
    {
        $history->delete();

        return redirect()->route('admin.shipments.show', $shipment)
            ->with('success', 'Shipment history deleted successfully.');
    }
}
