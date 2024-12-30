<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // OTP value
    public $recipientEmail; // The recipient's email

    /**
     * Create a new message instance.
     */
    public function __construct($otp, $recipientEmail)
    {
        $this->otp = $otp;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('eng8087722@gmail.com', 'No Reply'),
            to: new Address($this->recipientEmail) // Use the recipient's email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
        return new Content(
            view: 'emails.test',
            with: ['otp' => $this->otp] // Pass the OTP to the email content
        );
    }
}
