<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Mail;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email on investment completion';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      
            	$deposits = Deposit::where('status', 0)->get();
            	foreach($deposits as $deposit){
            	  $create_at = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Now());
                  $ex = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $deposit->expires_at);
                  if($create_at != $ex ){
    	        	mail::raw(['html'=>'emails.invesmentCompleted'], array('deposit' => $deposit), function($message) use ($deposit){
                    $message->from('support@nixoncapital.cc');
                    $message->subject('Your trade cycle has been completed Successfully');
                    $message->to('mikkynoble@gmail.com');
                    DB::table('deposits')->where('id', 3317)->update(['status'=> 1]);
                    
                     });
                  }
    	}
         
        }
}
