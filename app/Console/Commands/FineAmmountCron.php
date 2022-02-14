<?php

namespace App\Console\Commands;

use App\Models\BookIssue;
use Illuminate\Console\Command;

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
        $date = $data->created_at;
        $calculate = (int)((strtotime($date) - strtotime($data->return_date)) / 86400);
        $data = BookIssue::where('id', $data->id)->update([
            'status' => "3",
            'fine_ammount' => $calculate * 10,
        ]);
        return $calculate * 10;
    }
}
