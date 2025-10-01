<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Details - {{ $shipment->tracking_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }
        .company-details {
            font-size: 10px;
            color: #666;
        }
        .shipment-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin: 20px 0 10px 0;
        }
        .tracking-number {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 10px;
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin: 20px 0;
        }
        .info-section {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
        }
        .info-section h3 {
            background: #2563eb;
            color: white;
            padding: 8px 12px;
            margin: 0 0 10px 0;
            font-size: 14px;
            font-weight: bold;
        }
        .info-item {
            margin-bottom: 5px;
            font-size: 11px;
        }
        .info-label {
            font-weight: bold;
            color: #374151;
        }
        .info-value {
            color: #6b7280;
        }
        .status-section {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 15px;
            margin: 20px 0;
        }
        .status-badge {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .history-section {
            margin: 20px 0;
        }
        .history-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .history-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        .history-table th {
            background: #f3f4f6;
            color: #374151;
            padding: 8px;
            text-align: left;
            border: 1px solid #d1d5db;
            font-weight: bold;
        }
        .history-table td {
            padding: 6px 8px;
            border: 1px solid #d1d5db;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">{{ $company['name'] }}</div>
        <div class="company-details">
            {{ $company['address'] }}<br>
            Phone: {{ $company['phone'] }} | Email: {{ $company['email'] }}<br>
            Website: {{ $company['website'] }}
        </div>
    </div>

    <div class="shipment-title">Shipment Details</div>
    
    <div class="tracking-number">
        Tracking Number: {{ $shipment->tracking_number }}
    </div>

    <div class="info-grid">
        <div class="info-section">
            <h3>Sender Information</h3>
            <div class="info-item">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $shipment->shipper_name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $shipment->shipper_email }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Phone:</span>
                <span class="info-value">{{ $shipment->shipper_phone }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Address:</span>
                <span class="info-value">{{ $shipment->shipper_address }}</span>
            </div>
        </div>

        <div class="info-section">
            <h3>Receiver Information</h3>
            <div class="info-item">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $shipment->receiver_name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $shipment->receiver_email }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Phone:</span>
                <span class="info-value">{{ $shipment->receiver_phone }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Address:</span>
                <span class="info-value">{{ $shipment->receiver_address }}</span>
            </div>
        </div>
    </div>

    @if($shipment->origin || $shipment->destination)
    <div class="info-section">
        <h3>Route Information</h3>
        @if($shipment->origin)
        <div class="info-item">
            <span class="info-label">Origin:</span>
            <span class="info-value">{{ $shipment->origin }}</span>
        </div>
        @endif
        @if($shipment->destination)
        <div class="info-item">
            <span class="info-label">Destination:</span>
            <span class="info-value">{{ $shipment->destination }}</span>
        </div>
        @endif
    </div>
    @endif

    <div class="status-section">
        <div class="info-item">
            <span class="info-label">Current Status:</span>
            <span class="status-badge">{{ strtoupper(str_replace('_', ' ', $shipment->status)) }}</span>
        </div>
        @if($shipment->expected_delivery_date)
        <div class="info-item">
            <span class="info-label">Expected Delivery:</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($shipment->expected_delivery_date)->format('F j, Y') }}</span>
        </div>
        @endif
        <div class="info-item">
            <span class="info-label">Created:</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($shipment->created_at)->format('F j, Y \a\t g:i A') }}</span>
        </div>
    </div>

    @if($shipment->histories && count($shipment->histories) > 0)
    <div class="history-section">
        <div class="history-title">Shipment History</div>
        <table class="history-table">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Updated By</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shipment->histories as $history)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($history->created_at)->format('M j, Y g:i A') }}</td>
                    <td>{{ strtoupper(str_replace('_', ' ', $history->status)) }}</td>
                    <td>{{ $history->location ?? '-' }}</td>
                    <td>{{ $history->updated_by ?? '-' }}</td>
                    <td>{{ $history->note ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if($shipment->comments)
    <div class="info-section">
        <h3>Additional Comments</h3>
        <div class="info-value">{{ $shipment->comments }}</div>
    </div>
    @endif

    <div class="footer">
        <p>This document was generated on {{ now()->format('F j, Y \a\t g:i A') }}</p>
        <p>For support, contact {{ $company['email'] }} or visit {{ $company['website'] }}</p>
    </div>
</body>
</html>
