<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class contactUS extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'cuksmail@gmail.com';    
        $name = 'Evgenyi';    
        $subject = 'Email по Скрапу';    
        return $this->view('layouts.email')    
            ->from($address, $name)    
            ->subject($subject);
    }
}
