<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\HoaDon;
use Illuminate\Support\Facades\Auth;

class PaySuccess extends Mailable
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
        $user = Auth::guard('web')->user();
        $order = HoaDon::where('user_id',$user->id)->orderBy('id','desc')->first();
        return $this->view('pages.mail',compact('order'));
    }
}
