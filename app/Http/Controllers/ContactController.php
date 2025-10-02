<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'service' => 'required|string|in:air-freight,ocean-freight,road-freight,train-freight,warehousing,relocation',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'Please provide your name.',
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please provide a valid email address.',
            'service.required' => 'Please select a service.',
            'service.in' => 'Please select a valid service.',
            'message.required' => 'Please provide your message.',
            'message.max' => 'Your message is too long. Please keep it under 2000 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please correct the errors below.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get validated data
            $validatedData = $validator->validated();
            
            // Get company email from settings
            $companyEmail = \App\Models\Setting::get('company_email', 'info@example.com');
            $companyName = \App\Models\Setting::get('company_name', 'Shipping Company');
            
            // Prepare email data
            $emailData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? 'Not provided',
                'service' => ucwords(str_replace('-', ' ', $validatedData['service'])),
                'message' => $validatedData['message'],
                'companyName' => $companyName,
                'submittedAt' => now()->format('M j, Y \a\t g:i A'),
            ];

            // For now, skip email sending to avoid template issues
            // We'll add email functionality later once the basic form works
            \Log::info('Email would be sent to: ' . $companyEmail);
            \Log::info('Confirmation email would be sent to: ' . $validatedData['email']);

            // Always log the contact form submission
            \Log::info('Contact form submission received:', [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? 'Not provided',
                'service' => $validatedData['service'],
                'message' => $validatedData['message'],
                'submitted_at' => now()->toDateTimeString(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We have received your inquiry and will get back to you within 24 hours.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Contact form submission error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your message. Please try again or contact us directly.'
            ], 500);
        }
    }
}
