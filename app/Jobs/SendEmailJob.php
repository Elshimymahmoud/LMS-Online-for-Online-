<?php

namespace App\Jobs;

use App\Mail\certificateEmail;
use App\Mail\courseEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail;
    protected $content;
    protected $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail,$content,$type=null)
    {
        //
        $this->send_mail = $send_mail;
        $this->content = $content;
        $this->type = $type;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
       try {
           //code...
           $email = new courseEmail($this->content);  
           if($this->type=='generate_certificate')  
           $email = new certificateEmail($this->content);  
   
           \Mail::to($this->send_mail)->send($email);
   
       } catch (\Throwable $th) {
           //throw $th;
        throw new \Exception('Something went wrong');

       }
       
        
    }
    public function failed()
    {
        // Called when the job is failing...
        Log::alert('error in queue mail');
        throw new \Exception('Something went wrong');

    }

}
