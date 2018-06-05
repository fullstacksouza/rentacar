<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationSearch extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $view;
    public $user;
    public $search;
    public $subject = "Notificação de Pesquisa";
    public function __construct($view, $user, $search)
    {
        $this->view = $view;
        $this->user = $user;
        $this->search = $search;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = $this->view;
        $user = $this->user;
        $search = $this->search;
        return $this->view($view);
    }
}
