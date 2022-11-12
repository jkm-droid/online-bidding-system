<?php

namespace App\Services;

use App\Constants\AppConstants;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    /**
     * @var ChartDataService
     */
    private $_chartDataService;

    public function __construct(ChartDataService $chartDataService)
    {
        $this->_chartDataService = $chartDataService;
    }

    /**
     * @return Application|Factory|View
     */
    public function renderDashboard()
    {
        $logData = array(
            'module'=>AppConstants::$modules['contribution'],
            'log'=>'<bold>'.Auth::guard('admin')->user()->username.'</bold> visited system\'s dashboard'
        );
        $this->_systemService->addSystemLogActivity($logData);

        return view('admin.dashboard.dashboard')
            ->with('totalContributions', $this->_chartDataService->totalValueCounts('amount'))
            ->with('totalBalances', $this->_chartDataService->totalValueCounts('balance'))
            ->with('totalFines', $this->_chartDataService->totalValueCounts('fine'))
            ->with('totalAdvances', $this->_chartDataService->totalValueCounts('advance'))
            ->with('monthlyContributions',$this->_chartDataService->monthlyValueCounts('amount'))
            ->with('monthlyBalances',$this->_chartDataService->monthlyValueCounts('balance'))
            ->with('monthlyAdvances',$this->_chartDataService->monthlyValueCounts('advance'))
            ->with('monthlyFines',$this->_chartDataService->monthlyValueCounts('fine'));
    }
}
