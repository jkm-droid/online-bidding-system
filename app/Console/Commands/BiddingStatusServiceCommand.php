<?php

namespace App\Console\Commands;

use App\Services\Buyer\CheckBiddingStatusService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BiddingStatusServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bidding:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run the CheckBiddingStatusService every 2 minutes';
    /**
     * @var CheckBiddingStatusService
     */
    private $_biddingStatusService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CheckBiddingStatusService $biddingStatusService)
    {
        parent::__construct();
        $this->_biddingStatusService = $biddingStatusService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->_biddingStatusService->checkBiddingStatus();
    }
}
