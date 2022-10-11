<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use function PHPUnit\Framework\fileExists;

class MailReceipt extends Mailable
{
    use Queueable, SerializesModels;
    private $file;
    protected $message;
    protected $files_to_send;
    protected $object;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($file, $files_to_send, $message, $object)
    {
        $this->file = $file;
        $this->message = $message;
        $this->files_to_send = $files_to_send;
        $this->object = $object;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $object = $this->object;
        $email =  $this->from('achrafassila678@gmail.com', 'polassur')->subject($this->message)->view('emails.email_rec', compact('object'));
        $email->attach(public_path('storage\releve\\' . $this->file . '.pdf'));


        foreach ($this->files_to_send as $file) {
            if ($file) {

                $email->attach("D:\clients\ali boughaleb\quittances\\" . $file);
            } else {
                continue;
            }
        }

        return $email;
    }
}
