<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodigoUnicoTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigoUnico;

    /**
     * Create a new message instance.
     *
     * @param string $codigoUnico
     * @return void
     */
    public function __construct($codigoUnico)
    {
        $this->codigoUnico = $codigoUnico;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Código único de tu ticket')
            ->text("Tu código único es: {$this->codigoUnico}");
    }
}
