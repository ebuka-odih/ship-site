<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc3545; color: white; padding: 20px; text-align: center; }
        .content { background: #f8f9fa; padding: 30px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #dc3545; }
        .value { margin-top: 5px; }
        .footer { background: #343a40; color: white; padding: 20px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
            <p>{{ $companyName }}</p>
        </div>
        
        <div class="content">
            <p><strong>You have received a new contact form submission:</strong></p>
            
            <div class="field">
                <div class="label">Name:</div>
                <div class="value">{{ $name }}</div>
            </div>
            
            <div class="field">
                <div class="label">Email:</div>
                <div class="value">{{ $email }}</div>
            </div>
            
            <div class="field">
                <div class="label">Phone:</div>
                <div class="value">{{ $phone }}</div>
            </div>
            
            <div class="field">
                <div class="label">Service Required:</div>
                <div class="value">{{ $service }}</div>
            </div>
            
            <div class="field">
                <div class="label">Message:</div>
                <div class="value">{{ $message }}</div>
            </div>
            
            <div class="field">
                <div class="label">Submitted:</div>
                <div class="value">{{ $submittedAt }}</div>
            </div>
            
            <hr style="margin: 30px 0;">
            
            <p><strong>Next Steps:</strong></p>
            <ul>
                <li>Reply directly to this email to respond to the customer</li>
                <li>Or call the customer at: {{ $phone }}</li>
                <li>Follow up within 24 hours as promised</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>This email was automatically generated from your website contact form.</p>
        </div>
    </div>
</body>
</html>

