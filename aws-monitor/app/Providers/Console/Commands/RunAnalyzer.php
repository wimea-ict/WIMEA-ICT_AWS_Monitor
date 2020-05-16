<?php

namespace station\Console\Commands;

use Illuminate\Console\Command;
use station\Http\Controllers\NodeStatusAnalyzerController;

class RunAnalyzer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analyzer:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the Data Analyzer and Problem Classifier component';

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
        (new NodeStatusAnalyzerController())->analyze(); //to check out reports and send them
    }
}
