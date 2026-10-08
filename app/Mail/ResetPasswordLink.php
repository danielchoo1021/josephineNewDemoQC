<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordLink extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $resetLink, $websiteName, $companyName, $expiresInMinutes, $isChinese;

    /**
     * @param  string  $name              Account holder's name
     * @param  string  $resetLink         Full URL of the reset page (contains the one-time token)
     * @param  string  $websiteName       Shown in the subject and body
     * @param  string  $companyName       Shown in the footer
     * @param  int     $expiresInMinutes  How long the link stays valid
     * @param  bool    $isChinese         Send the Chinese version
     */
    public function __construct($name, $resetLink, $websiteName, $companyName, $expiresInMinutes = 60, $isChinese = false)
    {
        $this->name = $name;
        $this->resetLink = $resetLink;
        $this->websiteName = $websiteName;
        $this->companyName = $companyName;
        $this->expiresInMinutes = $expiresInMinutes;
        $this->isChinese = $isChinese;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->isChinese
            ? '重置密码 - '.$this->websiteName
            : 'Reset Your Password - '.$this->websiteName;

        return $this->from(config('mail.from.address'), $this->websiteName)
                    ->subject($subject)
                    ->view('emails.reset_password');
    }
}
