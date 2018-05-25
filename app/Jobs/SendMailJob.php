<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\NotificationSearch;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;
    public $view;
    public $search;
    public function __construct($view, $user, $search)
    {
        $this->user = $user;
        $this->view = $view;
        $this->search = $search;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $user = $this->user;
        $view = $this->view;
        $search = $this->search;
        $email = new NotificationSearch($view, $user, $search);
        //print_r($email);
        /* Mail::send($view, ['users' => $users], function ($message) use ($users) {
            $message->to($users)->subject('Notificação sobre Pesquisa');
        }); */

        Mail::to($this->user->email)->send($email);
    }

    public function failed()
    {

        file_put_contents(storage_path() . "/x.txt", "O job Falhou:");
    }
}
