<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShipmentPdfController extends Controller
{
    /**
     * Generate PDF for shipment details
     */
    public function generateShipmentPdf(Shipment $shipment)
    {
        $shipment->load(['user', 'histories' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        $html = view('pdfs.shipment-details', [
            'shipment' => $shipment,
            'company' => [
                'name' => 'ShipTrack',
                'address' => '123 Shipping Street, Logistics City, LC 12345',
                'phone' => '+1 (555) 123-4567',
                'email' => 'info@shiptrack.com',
                'website' => 'www.shiptrack.com'
            ]
        ])->render();

        return $this->generatePdfResponse($html, "shipment-{$shipment->tracking_number}.pdf");
    }

    /**
     * Generate shipping label PDF
     */
    public function generateShippingLabel(Shipment $shipment)
    {
        $html = view('pdfs.shipping-label', [
            'shipment' => $shipment,
            'company' => [
                'name' => 'ShipTrack',
                'address' => '123 Shipping Street, Logistics City, LC 12345',
                'phone' => '+1 (555) 123-4567',
                'email' => 'info@shiptrack.com'
            ]
        ])->render();

        return $this->generatePdfResponse($html, "shipping-label-{$shipment->tracking_number}.pdf");
    }

    /**
     * Generate invoice PDF
     */
    public function generateInvoice(Shipment $shipment)
    {
        $shipment->load('user');

        $html = view('pdfs.invoice', [
            'shipment' => $shipment,
            'company' => [
                'name' => 'ShipTrack',
                'address' => '123 Shipping Street, Logistics City, LC 12345',
                'phone' => '+1 (555) 123-4567',
                'email' => 'info@shiptrack.com',
                'website' => 'www.shiptrack.com',
                'tax_id' => 'TAX-123456789'
            ],
            'invoice_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(30)->format('Y-m-d')
        ])->render();

        return $this->generatePdfResponse($html, "invoice-{$shipment->tracking_number}.pdf");
    }

    /**
     * Generate PDF response using browser's print functionality
     */
    private function generatePdfResponse($html, $filename)
    {
        // Add print styles to the HTML
        $printStyles = '
        <style>
            @media print {
                body { margin: 0; }
                .no-print { display: none !important; }
                .page-break { page-break-before: always; }
            }
            @page {
                margin: 0.5in;
                size: A4;
            }
        </style>';

        $htmlWithStyles = str_replace('</head>', $printStyles . '</head>', $html);
        
        // Add print button with proper close functionality
        $printButton = '
        <div class="no-print" style="position: fixed; top: 10px; right: 10px; z-index: 1000; background: rgba(255,255,255,0.95); padding: 10px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <button onclick="window.print()" style="background: #3b82f6; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; margin-right: 10px;">
                🖨️ Print PDF
            </button>
            <button onclick="closeWindow()" style="background: #6b7280; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
                ✕ Close
            </button>
        </div>
        <script>
            function closeWindow() {
                try {
                    // Try to close the window first
                    if (window.opener) {
                        window.close();
                    } else {
                        // If that doesn\'t work, try to go back
                        if (window.history.length > 1) {
                            window.history.back();
                        } else {
                            // If no history, redirect to admin dashboard
                            window.location.href = "/admin/shipments";
                        }
                    }
                } catch (e) {
                    // Fallback: redirect to admin dashboard
                    window.location.href = "/admin/shipments";
                }
            }
            
            // Add keyboard shortcut for closing (Ctrl+W or Escape)
            document.addEventListener("keydown", function(event) {
                if (event.key === "Escape") {
                    closeWindow();
                }
            });
        </script>';

        $htmlWithPrint = str_replace('<body>', '<body>' . $printButton, $htmlWithStyles);

        return response($htmlWithPrint)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }
}
