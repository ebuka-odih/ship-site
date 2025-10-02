<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You for Contacting Us</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc3545; color: white; padding: 30px; text-align: center; }
        .content { background: #f8f9fa; padding: 30px; }
        .highlight { background: #e9ecef; padding: 20px; border-radius: 5px; margin: 20px 0; }
        .footer { background: #343a40; color: white; padding: 20px; text-align: center; font-size: 12px; }
        .service-badge { background: #dc3545; color: white; padding: 5px 10px; border-radius: 3px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thank You for Contacting {{ $companyName }}!</h2>
            <p>We've received your message and will respond within 24 hours.</p>
        </div>
        
        <div class="content">
            <p>Dear {{ $name }},</p>
            
            <p>Thank you for reaching out to us! We have received your inquiry and our logistics team will review your requirements and get back to you within 24 hours.</p>
            
            <div class="highlight">
                <h4>Your Inquiry Details:</h4>
                <p><strong>Service Required:</strong> <span class="service-badge">{{ $service }}</span></p>
                <p><strong>Submitted:</strong> {{ $submittedAt }}</p>
                <p><strong>Your Message:</strong></p>
                <p style="font-style: italic;">"{{ $message }}"</p>
            </div>
            
            <h4>What Happens Next?</h4>
            <ul>
                <li>Our logistics experts will review your requirements</li>
                <li>We'll prepare a customized quote for your shipping needs</li>
                <li>One of our specialists will contact you within 24 hours</li>
                <li>We'll discuss the best shipping solution for your business</li>
            </ul>
            
            <h4>Need Immediate Assistance?</h4>
            <p>If you have urgent shipping requirements, please don't hesitate to call us directly:</p>
            <p><strong>Phone:</strong> +1 (555) 123-4567<br>
            <strong>Email:</strong> info@example.com</p>
            
            <p>We look forward to helping you with your shipping needs!</p>
            
            <p>Best regards,<br>
            The {{ $companyName }} Team</p>
        </div>
        
        <div class="footer">
            <p>This is an automated confirmation email. Please do not reply to this message.</p>
            <p>{{ $companyName }} - Your Trusted Shipping Partner</p>
        </div>
    </div>
</body>
</html>
