<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class CodigoRecuperacionMail extends Mailable
{
    public $codigoRecuperacion;

    public function __construct($codigoRecuperacion)
    {
        $this->codigoRecuperacion = $codigoRecuperacion;
    }

    public function build()
    {
        return $this->subject('Código de recuperación')->view('emails.codigo-recuperacion');
    }
}
