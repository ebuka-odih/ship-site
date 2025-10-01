<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label - {{ $shipment->tracking_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
            margin: 0;
            padding: 10px;
        }
        .label-container {
            border: 2px solid #000;
            padding: 15px;
            max-width: 400px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #2563eb;
        }
        .tracking-number {
            background: #f0f0f0;
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
            margin: 10px 0;
            font-size: 14px;
            font-weight: bold;
            font-family: monospace;
        }
        .address-section {
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .address-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 5px;
            color: #2563eb;
        }
        .address-content {
            font-size: 11px;
            line-height: 1.4;
        }
        .barcode-area {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            border: 1px dashed #ccc;
            background: #f9f9f9;
        }
        .barcode-text {
            font-family: monospace;
            font-size: 10px;
            letter-spacing: 2px;
        }
        .service-info {
            margin: 10px 0;
            padding: 8px;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
        }
        .service-item {
            margin-bottom: 3px;
            font-size: 10px;
        }
        .service-label {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="label-container">
        <div class="header">
            <div class="company-name">{{ $company['name'] }}</div>
            <div style="font-size: 9px; color: #666;">
                {{ $company['phone'] }} | {{ $company['email'] }}
            </div>
        </div>

        <div class="tracking-number">
            {{ $shipment->tracking_number }}
        </div>

        <div class="address-section">
            <div class="address-title">FROM:</div>
            <div class="address-content">
                <strong>{{ $shipment->shipper_name }}</strong><br>
                {{ $shipment->shipper_address }}<br>
                {{ $shipment->shipper_phone }}<br>
                {{ $shipment->shipper_email }}
            </div>
        </div>

        <div class="address-section">
            <div class="address-title">TO:</div>
            <div class="address-content">
                <strong>{{ $shipment->receiver_name }}</strong><br>
                {{ $shipment->receiver_address }}<br>
                {{ $shipment->receiver_phone }}<br>
                {{ $shipment->receiver_email }}
            </div>
        </div>

        <div class="service-info">
            <div class="service-item">
                <span class="service-label">Service:</span> Standard Shipping
            </div>
            <div class="service-item">
                <span class="service-label">Weight:</span> {{ $shipment->weight ?? 'N/A' }}
            </div>
            <div class="service-item">
                <span class="service-label">Packages:</span> {{ $shipment->packages ?? '1' }}
            </div>
            @if($shipment->expected_delivery_date)
            <div class="service-item">
                <span class="service-label">Expected Delivery:</span> {{ \Carbon\Carbon::parse($shipment->expected_delivery_date)->format('M j, Y') }}
            </div>
            @endif
        </div>

        <div class="barcode-area">
            <div class="barcode-text">*{{ $shipment->tracking_number }}*</div>
            <div style="font-size: 8px; margin-top: 5px;">Scan for tracking</div>
        </div>

        <div class="footer">
            <div>Generated on {{ now()->format('M j, Y g:i A') }}</div>
            <div>For tracking, visit {{ $company['website'] }}</div>
        </div>
    </div>
</body>
</html>
