<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    /**
     * Display the settings page
     */
    public function index()
    {
        $settings = [
            'company' => [
                'name' => config('app.name', 'ShipTrack'),
                'email' => config('mail.from.address', 'noreply@shiptrack.com'),
                'phone' => '+1 (555) 123-4567',
                'address' => '123 Shipping Street, Logistics City, LC 12345',
                'website' => 'www.shiptrack.com',
            ],
            'mail' => [
                'driver' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
            ],
            'system' => [
                'timezone' => config('app.timezone'),
                'locale' => config('app.locale'),
                'debug' => config('app.debug'),
            ]
        ];

        return Inertia::render('Admin/Settings/Index', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'company_phone' => 'required|string|max:20',
            'company_address' => 'required|string',
            'company_website' => 'required|string|max:255',
        ]);

        // In a real application, you would save these to a settings table
        // For now, we'll just return success
        return redirect()->route('admin.settings')
            ->with('success', 'General settings updated successfully.');
    }

    /**
     * Update mail settings
     */
    public function updateMail(Request $request)
    {
        $request->validate([
            'mail_driver' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|integer',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
        ]);

        // In a real application, you would save these to a settings table
        return redirect()->route('admin.settings')
            ->with('success', 'Mail settings updated successfully.');
    }

    /**
     * Test mail configuration
     */
    public function testMail(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);

        try {
            \Mail::raw('This is a test email from ShipTrack.', function($message) use ($request) {
                $message->to($request->test_email)
                        ->subject('ShipTrack - Test Email');
            });

            return redirect()->route('admin.settings')
                ->with('success', 'Test email sent successfully to ' . $request->test_email);
        } catch (\Exception $e) {
            return redirect()->route('admin.settings')
                ->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }
}
