<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Pelanggan;

class PelangganRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $pelanggan;
    protected $randomPassword;
  
    public function __construct(Pelanggan $pelanggan, $randomPassword)
    {
        $this->pelanggan = $pelanggan;
        $this->randomPassword = $randomPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //MENGESET SUBJECT EMAIL, VIEW MANA YANG AKAN DI-LOAD DAN DATA APA YANG AKAN DIPASSING KE VIEW
        return $this->subject('Verifikasi Pendaftaran Anda')
            ->view('email.daftarPelanggan')
            ->with([
                'pelanggan' => $this->pelanggan,
                'password'  => $this->randomPassword
            ]);
    }
}
