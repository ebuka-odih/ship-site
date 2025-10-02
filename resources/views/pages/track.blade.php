@extends('pages.layout.app')
@section('content')

<!-- tracking-area -->
<section class="tracking__area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="tracking__content">
                    <!-- Tracking Input Section -->
                    <div class="tracking__input-section no-print">
                        <h2 class="tracking__title">ENTER THE CONSIGNMENT NO.</h2>
                        <form class="tracking__form" method="GET" action="{{ route('track') }}">
                            <div class="tracking__input-group">
                                <input type="text" name="tracking_number" class="tracking__input" 
                                       placeholder="Enter tracking number (e.g., SH65A1B2C3D4E5F)" value="{{ request('tracking_number') }}">
                                <button type="submit" class="tracking__btn">TRACK RESULT</button>
                            </div>
                            <p class="tracking__example">Enter your tracking number to view shipment details and history</p>
                        </form>
                    </div>

                    <!-- Tracking Result Section -->
                    @if($trackingNumber && $trackingData)
                    <div class="tracking__result-card">
                        <!-- Print Header (only visible in print) -->
                        <div class="print-header" style="display: none;">
                            <div style="text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px;">
                                <h1 style="margin: 0; font-size: 24px; color: #333;">{{ \App\Models\Setting::get('company_name', config('app.name')) }}</h1>
                                <p style="margin: 5px 0; font-size: 14px; color: #666;">Shipment Tracking Report</p>
                                <p style="margin: 0; font-size: 12px; color: #999;">Generated on: {{ now()->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                        <!-- Print Button -->
                        <div class="tracking__print">
                            <button onclick="window.print()" class="print__btn">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>

                        <!-- Tracking Header -->
                        <div class="tracking__header">
                            <div class="tracking__number-section">
                                <h3 class="tracking__number">Tracking No: {{ $trackingData['tracking_number'] }}</h3>
                                <div class="tracking__barcode">
                                    <!-- Barcode placeholder - you can integrate a barcode generator here -->
                                    <div class="barcode-placeholder">
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                        <div class="barcode-lines"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Sections -->
                        <div class="tracking__addresses">
                            <!-- Shipper Address -->
                            <div class="address__card">
                                <h4 class="address__title">Shipper Address</h4>
                                <div class="address__details">
                                    <div class="address__item">
                                        <span class="address__label">Shipper Name :</span>
                                        <span class="address__value">{{ $trackingData['shipper']['name'] }}</span>
                                    </div>
                                    <div class="address__item">
                                        <span class="address__label">Phone Number :</span>
                                        <span class="address__value">{{ $trackingData['shipper']['phone'] }}</span>
                                    </div>
                                    <div class="address__item">
                                        <span class="address__label">Address :</span>
                                        <span class="address__value">{{ $trackingData['shipper']['address'] }}</span>
                                    </div>
                                    <div class="address__item">
                                        <span class="address__label">Email :</span>
                                        <span class="address__value">{{ $trackingData['shipper']['email'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Receiver Address -->
                            <div class="address__card">
                                <h4 class="address__title">Receiver Address</h4>
                                <div class="address__details">
                                    <div class="address__item">
                                        <span class="address__label">Receiver Name :</span>
                                        <span class="address__value">{{ $trackingData['receiver']['name'] }}</span>
                                    </div>
                                    <div class="address__item">
                                        <span class="address__label">Phone Number :</span>
                                        <span class="address__value">{{ $trackingData['receiver']['phone'] }}</span>
                                    </div>
                                    <div class="address__item">
                                        <span class="address__label">Address :</span>
                                        <span class="address__value">{{ $trackingData['receiver']['address'] }}</span>
                                    </div>
                                    <div class="address__item">
                                        <span class="address__label">Email :</span>
                                        <span class="address__value">{{ $trackingData['receiver']['email'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipment Details -->
                        <div class="tracking__details">
                            <div class="details__grid">
                                <div class="details__item">
                                    <span class="details__label">Mode :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['mode'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Type of Shipment :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['type_of_shipment'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Courier :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['courier'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Packages :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['packages'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Quantity :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['quantity'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Payment Mode :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['payment_mode'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Carrier :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['carrier'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Carrier Reference No. :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['carrier_reference_no'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Weight :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['weight'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Product :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['product'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Total Freight :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['total_freight'] }}</span>
                                </div>
                                <div class="details__item">
                                    <span class="details__label">Departure Time :</span>
                                    <span class="details__value">{{ $trackingData['shipment_details']['departure_time'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tracking History -->
                        <div class="tracking__history">
                            <h4 class="history__title">Tracking History</h4>
                            <div class="history__table">
                                <table class="history-table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trackingData['tracking_history'] as $index => $event)
                                        <tr class="{{ $index === 0 ? 'latest' : '' }}">
                                            <td class="history__date">{{ $event['date'] }}</td>
                                            <td class="history__status">
                                                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $event['status'])) }}">
                                                    {{ $event['status'] }}
                                                </span>
                                            </td>
                                            <td class="history__location">{{ $event['location'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @elseif($trackingNumber && !$trackingData)
                    <!-- Tracking Not Found -->
                    <div class="tracking__not-found">
                        <div class="not-found__icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="not-found__title">Tracking Number Not Found</h3>
                        <p class="not-found__message">
                            The tracking number "{{ $trackingNumber }}" was not found in our system. 
                            Please check your tracking number and try again.
                        </p>
                        <div class="not-found__suggestions">
                            <h4>Please check:</h4>
                            <ul>
                                <li>Make sure you entered the correct tracking number</li>
                                <li>Check for any typos or extra spaces</li>
                                <li>Try entering the tracking number without any prefixes</li>
                                <li>Contact customer support if the issue persists</li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- tracking-area-end -->

<style>
/* Tracking Page Styles */
.tracking__area {
    padding: 80px 0;
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* Print Styles */
@media print {
    * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
    }
    
    html, body {
        background: white !important;
        color: black !important;
        font-size: 12px;
        line-height: 1.4;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: auto !important;
    }
    
    body {
        overflow: visible !important;
    }
    
    .tracking__area {
        padding: 0 !important;
        background: white !important;
        min-height: auto !important;
    }
    
    .tracking__content {
        background: white !important;
        box-shadow: none !important;
        border: 1px solid #ddd !important;
        padding: 20px !important;
        margin: 0 !important;
    }
    
    .tracking__input-section {
        display: none !important;
    }
    
    .tracking__print {
        display: none !important;
    }
    
    .print-header {
        display: block !important;
    }
    
    .tracking__header {
        border-bottom: 2px solid #333 !important;
        margin-bottom: 20px !important;
        padding-bottom: 15px !important;
    }
    
    .tracking__number {
        font-size: 16px !important;
        font-weight: bold !important;
        color: #333 !important;
    }
    
    .tracking__barcode {
        margin: 10px 0 !important;
    }
    
    .barcode-placeholder {
        height: 30px !important;
    }
    
    .barcode-lines {
        height: 25px !important;
        background-color: #333 !important;
    }
    
    .tracking__addresses {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 20px !important;
        margin-bottom: 20px !important;
    }
    
    .address__card {
        background: #f8f9fa !important;
        border: 1px solid #ddd !important;
        padding: 15px !important;
        page-break-inside: avoid !important;
    }
    
    .address__title {
        font-size: 14px !important;
        font-weight: bold !important;
        color: #333 !important;
        margin-bottom: 10px !important;
        text-transform: uppercase !important;
    }
    
    .address__item {
        margin-bottom: 5px !important;
    }
    
    .address__label {
        font-size: 11px !important;
        color: #666 !important;
        font-weight: 500 !important;
    }
    
    .address__value {
        font-size: 11px !important;
        color: #333 !important;
        font-weight: 600 !important;
    }
    
    .tracking__details {
        border-top: 1px solid #ddd !important;
        padding-top: 15px !important;
        page-break-inside: avoid !important;
    }
    
    .details__grid {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 8px !important;
    }
    
    .details__item {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 3px 0 !important;
        border-bottom: 1px solid #f0f0f0 !important;
    }
    
    .details__label {
        font-size: 10px !important;
        color: #666 !important;
        font-weight: 500 !important;
    }
    
    .details__value {
        font-size: 10px !important;
        color: #333 !important;
        font-weight: 600 !important;
    }
    
    /* Page breaks */
    .tracking__result-card {
        page-break-inside: avoid !important;
    }
    
    /* Hide elements not needed in print */
    .no-print {
        display: none !important;
    }
    
    /* Hide footer and navigation from print */
    footer,
    .footer__area,
    .footer__area-two,
    header,
    .tg-header__area,
    .tg-header__top,
    .newsletter__area,
    .about__area,
    .services__area,
    .work__area,
    .cta__area,
    .testimonial__area,
    .video__area,
    .slider__area,
    .breadcrumb__area,
    .preloader,
    .scroll__top,
    .tgmobile__menu,
    .tgmenu__action,
    .tgmenu__navbar-wrap {
        display: none !important;
    }
    
    /* Hide specific sections that might appear */
    .footer__widget,
    .footer__link,
    .footer__info-wrap,
    .navigation,
    .tgmenu__wrap {
        display: none !important;
    }
    
    /* Ensure proper spacing */
    @page {
        margin: 0.5in;
        size: A4;
    }
}

.tracking__content {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 40px;
}

/* Tracking Input Section */
.tracking__input-section {
    text-align: center;
    margin-bottom: 40px;
}

.tracking__title {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.tracking__form {
    max-width: 500px;
    margin: 0 auto;
}

.tracking__input-group {
    display: flex;
    gap: 15px;
    margin-bottom: 10px;
}

.tracking__input {
    flex: 1;
    padding: 15px 20px;
    border: 2px solid #e1e5e9;
    border-radius: 4px;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s ease;
}

.tracking__input:focus {
    border-color: #007bff;
}

.tracking__btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.tracking__btn:hover {
    background-color: #218838;
}

.tracking__example {
    color: #6c757d;
    font-size: 14px;
    margin: 0;
}

/* Tracking Result Card */
.tracking__result-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 30px;
    position: relative;
}

.tracking__print {
    position: absolute;
    top: 20px;
    right: 20px;
}

.print__btn {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 18px;
    cursor: pointer;
    padding: 8px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.print__btn:hover {
    background-color: #f8f9fa;
}

/* Tracking Header */
.tracking__header {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e9ecef;
}

.tracking__number {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.tracking__barcode {
    margin-bottom: 20px;
}

.barcode-placeholder {
    display: flex;
    gap: 2px;
    align-items: center;
    height: 40px;
}

.barcode-lines {
    width: 2px;
    height: 30px;
    background-color: #333;
    border-radius: 1px;
}


/* Address Sections */
.tracking__addresses {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.address__card {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    padding: 20px;
}

.address__title {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.address__details {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.address__item {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.address__label {
    font-size: 12px;
    color: #6c757d;
    font-weight: 500;
}

.address__value {
    font-size: 14px;
    color: #333;
    font-weight: 500;
}

/* Shipment Details */
.tracking__details {
    border-top: 1px solid #e9ecef;
    padding-top: 20px;
}

.details__grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.details__item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fa;
}

.details__label {
    font-size: 14px;
    color: #6c757d;
    font-weight: 500;
}

.details__value {
    font-size: 14px;
    color: #333;
    font-weight: 600;
}

/* Tracking History Styles */
.tracking__history {
    margin-top: 30px;
    border-top: 1px solid #e9ecef;
    padding-top: 20px;
}

.history__title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.history__table {
    overflow-x: auto;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.history-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    font-size: 14px;
}

.history-table thead {
    background: #f8f9fa;
    border-bottom: 2px solid #e9ecef;
}

.history-table th {
    padding: 15px 20px;
    text-align: left;
    font-weight: 600;
    color: #333;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-right: 1px solid #e9ecef;
}

.history-table th:last-child {
    border-right: none;
}

.history-table tbody tr {
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.2s ease;
}

.history-table tbody tr:hover {
    background-color: #f8f9fa;
}

.history-table tbody tr.latest {
    background-color: #e8f5e8;
    border-left: 4px solid #28a745;
}

.history-table tbody tr.latest:hover {
    background-color: #d4edda;
}

.history-table td {
    padding: 15px 20px;
    vertical-align: middle;
    border-right: 1px solid #f0f0f0;
}

.history-table td:last-child {
    border-right: none;
}

.history__date {
    font-weight: 500;
    color: #333;
    font-size: 13px;
}

.history__status {
    text-align: center;
}

.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid transparent;
}

.status-shipment-created {
    background-color: #e3f2fd;
    color: #1976d2;
    border-color: #bbdefb;
}

.status-package-picked-up {
    background-color: #fff3e0;
    color: #f57c00;
    border-color: #ffcc02;
}

.status-in-transit {
    background-color: #e8f5e8;
    color: #388e3c;
    border-color: #a5d6a7;
}

.status-delivered {
    background-color: #e8f5e8;
    color: #2e7d32;
    border-color: #81c784;
}

.status-expected-delivery {
    background-color: #f3e5f5;
    color: #7b1fa2;
    border-color: #ce93d8;
}

.history__location {
    color: #666;
    font-size: 13px;
    font-weight: 500;
}

/* Print styles for tracking history */
@media print {
    .tracking__history {
        margin-top: 20px !important;
        border-top: 1px solid #ddd !important;
        padding-top: 15px !important;
        page-break-inside: avoid !important;
    }
    
    .history__title {
        font-size: 14px !important;
        margin-bottom: 15px !important;
    }
    
    .history-table {
        font-size: 10px !important;
    }
    
    .history-table th {
        padding: 8px 12px !important;
        font-size: 10px !important;
    }
    
    .history-table td {
        padding: 8px 12px !important;
    }
    
    .history__date {
        font-size: 10px !important;
    }
    
    .status-badge {
        padding: 4px 8px !important;
        font-size: 9px !important;
    }
    
    .history__location {
        font-size: 10px !important;
    }
}

/* Tracking Not Found Styles */
.tracking__not-found {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 40px;
    text-align: center;
}

.not-found__icon {
    font-size: 48px;
    color: #6c757d;
    margin-bottom: 20px;
}

.not-found__title {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.not-found__message {
    font-size: 16px;
    color: #6c757d;
    margin-bottom: 30px;
    line-height: 1.6;
}

.not-found__suggestions {
    background: #f8f9fa;
    border-radius: 6px;
    padding: 20px;
    text-align: left;
    max-width: 500px;
    margin: 0 auto;
}

.not-found__suggestions h4 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.not-found__suggestions ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.not-found__suggestions li {
    padding: 8px 0;
    color: #6c757d;
    position: relative;
    padding-left: 20px;
}

.not-found__suggestions li::before {
    content: "•";
    color: #007bff;
    font-weight: bold;
    position: absolute;
    left: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .tracking__content {
        padding: 20px;
    }
    
    .tracking__input-group {
        flex-direction: column;
    }
    
    .tracking__addresses {
        grid-template-columns: 1fr;
    }
    
    .tracking__header {
        text-align: center;
    }
    
    .details__grid {
        grid-template-columns: 1fr;
    }
    
    .tracking__not-found {
        padding: 30px 20px;
    }
    
    .not-found__title {
        font-size: 20px;
    }
    
    .not-found__message {
        font-size: 14px;
    }
}
</style>

@endsection
