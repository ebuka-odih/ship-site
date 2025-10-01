<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $shipment->tracking_number }}</title>
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
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
        }
        .company-info {
            flex: 1;
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
            line-height: 1.3;
        }
        .invoice-info {
            text-align: right;
            flex: 1;
        }
        .invoice-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .invoice-details {
            font-size: 11px;
            color: #666;
        }
        .billing-section {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
        .billing-info {
            flex: 1;
            margin-right: 20px;
        }
        .billing-title {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
            padding: 8px 12px;
            background: #f3f4f6;
            border-left: 4px solid #2563eb;
        }
        .billing-details {
            font-size: 11px;
            line-height: 1.4;
        }
        .shipment-details {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 15px;
            margin: 20px 0;
        }
        .shipment-title {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .shipment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            font-size: 11px;
        }
        .shipment-item {
            margin-bottom: 5px;
        }
        .shipment-label {
            font-weight: bold;
            color: #374151;
        }
        .shipment-value {
            color: #6b7280;
        }
        .tracking-number {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 10px;
            text-align: center;
            margin: 15px 0;
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
        }
        .charges-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 11px;
        }
        .charges-table th {
            background: #f3f4f6;
            color: #374151;
            padding: 8px;
            text-align: left;
            border: 1px solid #d1d5db;
            font-weight: bold;
        }
        .charges-table td {
            padding: 6px 8px;
            border: 1px solid #d1d5db;
        }
        .charges-table .total-row {
            background: #f9fafb;
            font-weight: bold;
        }
        .total-section {
            text-align: right;
            margin: 20px 0;
        }
        .total-amount {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            background: #f3f4f6;
            padding: 10px 20px;
            border: 1px solid #d1d5db;
            display: inline-block;
        }
        .payment-terms {
            margin: 20px 0;
            padding: 15px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
        }
        .payment-title {
            font-size: 12px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
        }
        .payment-details {
            font-size: 10px;
            color: #666;
            line-height: 1.4;
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
        <div class="company-info">
            <div class="company-name">{{ $company['name'] }}</div>
            <div class="company-details">
                {{ $company['address'] }}<br>
                Phone: {{ $company['phone'] }}<br>
                Email: {{ $company['email'] }}<br>
                Website: {{ $company['website'] }}<br>
                Tax ID: {{ $company['tax_id'] }}
            </div>
        </div>
        <div class="invoice-info">
            <div class="invoice-title">INVOICE</div>
            <div class="invoice-details">
                <strong>Invoice #:</strong> {{ $shipment->tracking_number }}<br>
                <strong>Date:</strong> {{ $invoice_date }}<br>
                <strong>Due Date:</strong> {{ $due_date }}<br>
                <strong>Status:</strong> {{ strtoupper(str_replace('_', ' ', $shipment->status)) }}
            </div>
        </div>
    </div>

    <div class="billing-section">
        <div class="billing-info">
            <div class="billing-title">Bill To:</div>
            <div class="billing-details">
                <strong>{{ $shipment->receiver_name }}</strong><br>
                {{ $shipment->receiver_address }}<br>
                {{ $shipment->receiver_phone }}<br>
                {{ $shipment->receiver_email }}
            </div>
        </div>
        <div class="billing-info">
            <div class="billing-title">Ship To:</div>
            <div class="billing-details">
                <strong>{{ $shipment->receiver_name }}</strong><br>
                {{ $shipment->receiver_address }}<br>
                {{ $shipment->receiver_phone }}<br>
                {{ $shipment->receiver_email }}
            </div>
        </div>
    </div>

    <div class="tracking-number">
        Tracking Number: {{ $shipment->tracking_number }}
    </div>

    <div class="shipment-details">
        <div class="shipment-title">Shipment Information</div>
        <div class="shipment-grid">
            <div>
                <div class="shipment-item">
                    <span class="shipment-label">Origin:</span>
                    <span class="shipment-value">{{ $shipment->origin ?? 'N/A' }}</span>
                </div>
                <div class="shipment-item">
                    <span class="shipment-label">Destination:</span>
                    <span class="shipment-value">{{ $shipment->destination ?? 'N/A' }}</span>
                </div>
                <div class="shipment-item">
                    <span class="shipment-label">Weight:</span>
                    <span class="shipment-value">{{ $shipment->weight ?? 'N/A' }}</span>
                </div>
                <div class="shipment-item">
                    <span class="shipment-label">Packages:</span>
                    <span class="shipment-value">{{ $shipment->packages ?? '1' }}</span>
                </div>
            </div>
            <div>
                <div class="shipment-item">
                    <span class="shipment-label">Service:</span>
                    <span class="shipment-value">{{ $shipment->mode ?? 'Standard' }}</span>
                </div>
                <div class="shipment-item">
                    <span class="shipment-label">Courier:</span>
                    <span class="shipment-value">{{ $shipment->courier ?? 'N/A' }}</span>
                </div>
                <div class="shipment-item">
                    <span class="shipment-label">Expected Delivery:</span>
                    <span class="shipment-value">
                        @if($shipment->expected_delivery_date)
                            {{ \Carbon\Carbon::parse($shipment->expected_delivery_date)->format('M j, Y') }}
                        @else
                            N/A
                        @endif
                    </span>
                </div>
                <div class="shipment-item">
                    <span class="shipment-label">Created:</span>
                    <span class="shipment-value">{{ \Carbon\Carbon::parse($shipment->created_at)->format('M j, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <table class="charges-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Shipping Service</td>
                <td>1</td>
                <td>${{ number_format($shipment->total_freight ? (float)$shipment->total_freight : 25.00, 2) }}</td>
                <td>${{ number_format($shipment->total_freight ? (float)$shipment->total_freight : 25.00, 2) }}</td>
            </tr>
            @if($shipment->weight && (float)$shipment->weight > 1)
            <tr>
                <td>Weight Surcharge</td>
                <td>{{ $shipment->weight }} kg</td>
                <td>$2.00</td>
                <td>${{ number_format((float)$shipment->weight * 2, 2) }}</td>
            </tr>
            @endif
            <tr class="total-row">
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>${{ number_format($shipment->total_freight ? (float)$shipment->total_freight : 25.00, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-amount">
            Total Amount: ${{ number_format($shipment->total_freight ? (float)$shipment->total_freight : 25.00, 2) }}
        </div>
    </div>

    <div class="payment-terms">
        <div class="payment-title">Payment Terms</div>
        <div class="payment-details">
            Payment is due within 30 days of invoice date. Late payments may be subject to a 1.5% monthly service charge.<br>
            For questions about this invoice, please contact us at {{ $company['email'] }} or {{ $company['phone'] }}.
        </div>
    </div>

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>This invoice was generated on {{ now()->format('F j, Y \a\t g:i A') }}</p>
        <p>For support, contact {{ $company['email'] }} or visit {{ $company['website'] }}</p>
    </div>
</body>
</html>
