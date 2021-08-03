<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRegisterMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $hash = md5(time() . rand(0, 999));
        $data = [
            'nome' => 'Rafael Batista',
            'telefone' => '+55 11 98681-9042',
            'email' => 'batist11@gmail.com',
            'msg' => 'Salve',
            'url' => url('/register-confirmation?token_confirmation=' . $hash)
        ];

        return $this->markdown('email.register', $data);
        // return $this->subject('teste')->to('batist11@gmail.com', 'Rafael')->view('email.test');
    }
}
