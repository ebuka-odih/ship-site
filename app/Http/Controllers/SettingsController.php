<?php

namespace App\Http\Controllers;

use App\Models\Setting;
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
                'name' => Setting::get('company_name', config('app.name', 'ShipSite')),
                'email' => Setting::get('company_email', config('mail.from.address', 'noreply@shiptrack.com')),
                'phone' => Setting::get('company_phone', '+1 (555) 123-4567'),
                'address' => Setting::get('company_address', '123 Shipping Street, Logistics City, LC 12345'),
                'website' => Setting::get('company_website', 'www.shiptrack.com'),
            ],
            'mail' => [
                'driver' => Setting::get('mail_driver', config('mail.default')),
                'host' => Setting::get('mail_host', config('mail.mailers.smtp.host')),
                'port' => Setting::get('mail_port', config('mail.mailers.smtp.port')),
                'encryption' => Setting::get('mail_encryption', config('mail.mailers.smtp.encryption')),
            ],
            'system' => [
                'timezone' => config('app.timezone'),
                'locale' => config('app.locale'),
                'debug' => config('app.debug'),
            ],
            'livechat' => [
                'script' => Setting::get('livechat_script', ''),
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
            'company_website' => 'nullable|string|max:255',
        ]);

        // Save settings to database
        Setting::set('company_name', $request->company_name);
        Setting::set('company_email', $request->company_email);
        Setting::set('company_phone', $request->company_phone);
        Setting::set('company_address', $request->company_address);
        Setting::set('company_website', $request->company_website);

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

        // Save mail settings to database
        Setting::set('mail_driver', $request->mail_driver);
        Setting::set('mail_host', $request->mail_host);
        Setting::set('mail_port', $request->mail_port);
        Setting::set('mail_encryption', $request->mail_encryption);
        Setting::set('mail_username', $request->mail_username);
        Setting::set('mail_password', $request->mail_password);

        return redirect()->route('admin.settings')
            ->with('success', 'Mail settings updated successfully.');
    }

    /**
     * Update livechat settings
     */
    public function updateLivechat(Request $request)
    {
        $request->validate([
            'livechat_script' => 'nullable|string',
        ]);

        // Save livechat script to database
        Setting::set('livechat_script', $request->livechat_script);

        return redirect()->route('admin.settings')
            ->with('success', 'Livechat settings updated successfully.');
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
