<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Update</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .container {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #6b7280;
            font-size: 16px;
        }
        .tracking-number {
            background: #f3f4f6;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }
        .tracking-number-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 5px;
        }
        .tracking-number-value {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            font-family: monospace;
        }
        .update-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .update-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-confirmed { background: #dbeafe; color: #1e40af; }
        .status-processing { background: #ede9fe; color: #7c3aed; }
        .status-picked_up { background: #e0e7ff; color: #3730a3; }
        .status-in_transit { background: #e0f2fe; color: #0369a1; }
        .status-out_for_delivery { background: #cffafe; color: #0e7490; }
        .status-delivery_attempted { background: #fed7aa; color: #c2410c; }
        .status-delivered { background: #d1fae5; color: #065f46; }
        .status-returned { background: #fce7f3; color: #be185d; }
        .status-cancelled { background: #fee2e2; color: #dc2626; }
        .status-on_hold { background: #fef3c7; color: #92400e; }
        .status-exception { background: #fee2e2; color: #dc2626; }
        .update-time {
            color: #6b7280;
            font-size: 14px;
        }
        .update-details {
            margin-top: 15px;
        }
        .detail-item {
            margin-bottom: 8px;
            font-size: 14px;
        }
        .detail-label {
            font-weight: 600;
            color: #374151;
        }
        .detail-value {
            color: #6b7280;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }
        .info-section {
            background: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            border-left: 4px solid #3b82f6;
        }
        .info-section h3 {
            margin: 0 0 15px 0;
            color: #1f2937;
            font-size: 16px;
            font-weight: 600;
        }
        .info-item {
            margin-bottom: 8px;
            font-size: 14px;
        }
        .info-label {
            font-weight: 600;
            color: #374151;
        }
        .info-value {
            color: #6b7280;
        }
        .cta-button {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .update-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">📦 ShipTrack</div>
            <h1 class="title">Shipment Update</h1>
            <p class="subtitle">Your shipment status has been updated</p>
        </div>

        <div class="tracking-number">
            <div class="tracking-number-label">Tracking Number</div>
            <div class="tracking-number-value">{{ $shipment->tracking_number }}</div>
        </div>

        <div class="update-card">
            <div class="update-header">
                <span class="status-badge status-{{ $history->status }}">
                    {{ strtoupper(str_replace('_', ' ', $history->status)) }}
                </span>
                <span class="update-time">
                    {{ \Carbon\Carbon::parse($history->created_at)->format('M j, Y \a\t g:i A') }}
                </span>
            </div>
            
            <div class="update-details">
                @if($history->location)
                <div class="detail-item">
                    <span class="detail-label">📍 Location:</span>
                    <span class="detail-value">{{ $history->location }}</span>
                </div>
                @endif
                
                @if($history->updated_by)
                <div class="detail-item">
                    <span class="detail-label">👤 Updated by:</span>
                    <span class="detail-value">{{ $history->updated_by }}</span>
                </div>
                @endif
                
                @if($history->note)
                <div class="detail-item">
                    <span class="detail-label">📝 Note:</span>
                    <span class="detail-value">{{ $history->note }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="info-grid">
            <div class="info-section">
                <h3>📤 Sender Information</h3>
                <div class="info-item">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ $shipment->shipper_name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $shipment->shipper_email }}</span>
                </div>
            </div>

            <div class="info-section">
                <h3>📥 Receiver Information</h3>
                <div class="info-item">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ $shipment->receiver_name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $shipment->receiver_email }}</span>
                </div>
            </div>
        </div>

        @if($shipment->expected_delivery_date)
        <div class="info-section">
            <h3>📅 Expected Delivery</h3>
            <div class="info-item">
                <span class="info-label">Date:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($shipment->expected_delivery_date)->format('F j, Y') }}</span>
            </div>
        </div>
        @endif

        <div style="text-align: center;">
            <a href="{{ url('/admin/shipments/' . $shipment->id) }}" class="cta-button">
                View Full Shipment Details
            </a>
        </div>

        <div class="footer">
            <p>This is an automated notification from ShipTrack.</p>
            <p>For support, please contact our customer service team.</p>
        </div>
    </div>
</body>
</html>
