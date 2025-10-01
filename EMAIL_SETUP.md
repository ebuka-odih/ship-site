# Email Setup Guide

## Overview
This application sends email notifications when:
1. A new shipment is created
2. Shipment status is updated (history added)

## Email Templates Created

### 1. Shipment Created Email
- **File**: `app/Mail/ShipmentCreatedMail.php`
- **Template**: `resources/views/emails/shipment-created.blade.php`
- **Triggered**: When a new shipment is created
- **Recipient**: Receiver email address

### 2. Shipment History Email
- **File**: `app/Mail/ShipmentHistoryMail.php`
- **Template**: `resources/views/emails/shipment-history.blade.php`
- **Triggered**: When shipment status is updated
- **Recipient**: Receiver email address

## Email Configuration

Add these settings to your `.env` file:

### For Local Testing (Mailtrap - Recommended)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@shiptrack.com"
MAIL_FROM_NAME="ShipTrack"
```

### For Gmail
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@shiptrack.com"
MAIL_FROM_NAME="ShipTrack"
```

### For Production (Mailgun)
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your_domain.mailgun.org
MAILGUN_SECRET=your_mailgun_secret
MAIL_FROM_ADDRESS="noreply@shiptrack.com"
MAIL_FROM_NAME="ShipTrack"
```

## Testing Email Functionality

### 1. Using Mailtrap (Recommended for Development)
1. Sign up at [mailtrap.io](https://mailtrap.io)
2. Create a new inbox
3. Copy the SMTP credentials to your `.env` file
4. Create a test shipment to trigger the email

### 2. Using Gmail
1. Enable 2-factor authentication on your Gmail account
2. Generate an App Password
3. Use the App Password in your `.env` file

### 3. Testing Commands
```bash
# Test mail configuration
php artisan tinker
>>> Mail::raw('Test email', function($message) { $message->to('test@example.com')->subject('Test'); });

# Send a test shipment created email
php artisan tinker
>>> $shipment = App\Models\Shipment::first();
>>> Mail::to('test@example.com')->send(new App\Mail\ShipmentCreatedMail($shipment));
```

## Email Template Features

### Shipment Created Email
- Professional design with company branding
- Tracking number prominently displayed
- Sender and receiver information
- Route information (if available)
- Expected delivery date
- Status badge with color coding
- Call-to-action button to view details

### Shipment History Email
- Status update with color-coded badge
- Location information (if provided)
- Updated by information (if provided)
- Note/remarks (if provided)
- Timestamp of the update
- Sender and receiver information
- Call-to-action button to view full details

## Error Handling

The email sending is wrapped in try-catch blocks to prevent failures:
- If email fails to send, it's logged but doesn't break the shipment creation/update
- Errors are logged to Laravel's log file
- Users can still create shipments and add history even if emails fail

## Customization

### Email Templates
- Templates are located in `resources/views/emails/`
- Use Blade templating for dynamic content
- Responsive design for mobile devices
- Professional styling with company colors

### Mail Classes
- Located in `app/Mail/`
- Customize subject lines and content
- Add additional recipients if needed
- Modify email logic as required

## Troubleshooting

### Common Issues
1. **Emails not sending**: Check mail configuration in `.env`
2. **SMTP errors**: Verify credentials and server settings
3. **Template errors**: Check Blade syntax in email templates
4. **Permission issues**: Ensure mail directory is writable

### Debug Steps
1. Check Laravel logs: `storage/logs/laravel.log`
2. Test mail configuration with tinker
3. Verify SMTP credentials
4. Check firewall settings for outbound email
