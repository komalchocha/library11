<?php

namespace App\Console\Commands;

use App\Models\BookIssue;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon as SupportCarbon;

class FineAmmountCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Fine:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
     $data = BookIssue::get(); 
     foreach ($data as $date) {
        if(($date['status'] == 1) && ($date['return_date'] < $date['created_at'])){
         $calculate = (int)((strtotime($date) - strtotime($date['return_date'])) / 86400);

         $data = BookIssue::where('id', $date['id'])->update([
            'status' => "3",
            'fine_ammount' => $calculate * 10,
        ]);

    }
    
     }
     
    }
}
