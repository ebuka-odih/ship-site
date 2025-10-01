<?php

namespace App\Mail;

use App\Models\Shipment;
use App\Models\ShipmentHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShipmentHistoryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Shipment $shipment,
        public ShipmentHistory $history
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipment Update - ' . $this->shipment->tracking_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.shipment-history',
            with: [
                'shipment' => $this->shipment,
                'history' => $this->history,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
