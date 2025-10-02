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

            // Send emails to admin and customer
            try {
                // Send email to admin (company email from settings)
                Mail::raw($this->getAdminEmailContent($emailData), function ($message) use ($companyEmail, $companyName, $validatedData) {
                    $message->to($companyEmail, $companyName)
                            ->subject('New Contact Form Submission - ' . $validatedData['name'])
                            ->replyTo($validatedData['email'], $validatedData['name']);
                });

                // Send confirmation email to customer
                Mail::raw($this->getCustomerEmailContent($emailData), function ($message) use ($validatedData, $companyName) {
                    $message->to($validatedData['email'], $validatedData['name'])
                            ->subject('Thank you for contacting ' . $companyName);
                });

                \Log::info('Emails sent successfully to admin: ' . $companyEmail . ' and customer: ' . $validatedData['email']);
            } catch (\Exception $emailError) {
                // Log email error but don't fail the form submission
                \Log::warning('Email sending failed: ' . $emailError->getMessage());
            }

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

    /**
     * Generate admin email content
     */
    private function getAdminEmailContent($emailData)
    {
        return "
NEW CONTACT FORM SUBMISSION

You have received a new contact form submission from your website:

Name: {$emailData['name']}
Email: {$emailData['email']}
Phone: {$emailData['phone']}
Service Required: {$emailData['service']}
Submitted: {$emailData['submittedAt']}

Message:
{$emailData['message']}

---
Next Steps:
- Reply directly to this email to respond to the customer
- Or call the customer at: {$emailData['phone']}
- Follow up within 24 hours as promised

This email was automatically generated from your website contact form.
        ";
    }

    /**
     * Generate customer confirmation email content
     */
    private function getCustomerEmailContent($emailData)
    {
        return "
Dear {$emailData['name']},

Thank you for contacting {$emailData['companyName']}!

We have received your inquiry and our logistics team will review your requirements and get back to you within 24 hours.

Your Inquiry Details:
- Service Required: {$emailData['service']}
- Submitted: {$emailData['submittedAt']}
- Your Message: {$emailData['message']}

What Happens Next?
- Our logistics experts will review your requirements
- We'll prepare a customized quote for your shipping needs
- One of our specialists will contact you within 24 hours
- We'll discuss the best shipping solution for your business

Need Immediate Assistance?
If you have urgent shipping requirements, please don't hesitate to call us directly.

We look forward to helping you with your shipping needs!

Best regards,
The {$emailData['companyName']} Team

---
This is an automated confirmation email. Please do not reply to this message.
        ";
    }
}
