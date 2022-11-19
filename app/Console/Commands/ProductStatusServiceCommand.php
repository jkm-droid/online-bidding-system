<?php

namespace App\Console\Commands;

use App\Services\Buyer\CheckProductStatusService;
use Illuminate\Console\Command;

class ProductStatusServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run the CheckProductStatusService every 2 minutes';
    /**
     * @var CheckProductStatusService
     */
    private $_productStatusService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CheckProductStatusService $productStatusService)
    {
        parent::__construct();
        $this->_productStatusService = $productStatusService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->_productStatusService->checkIfProductHasBids();
    }
}
