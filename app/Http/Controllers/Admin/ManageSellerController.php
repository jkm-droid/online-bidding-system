<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ManageSellersService;
use Illuminate\Http\Request;

class ManageSellerController extends Controller
{
    /**
     * @var ManageSellersService
     */
    private $sellerService;

    public function __construct(ManageSellersService $sellerService)
    {
        $this->middleware('auth:admin');
        $this->sellerService = $sellerService;
    }

    /**
     * Get sellers
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getSellers()
    {
        return $this->sellerService->getSellers();
    }

    /**
     * Create page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addNewSellerForm()
    {
        return view('admin.sellers.create');
    }

    /**
     * Add new seller
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewSeller(Request $request)
    {
      return $this->sellerService->createNewSeller($request);
    }

    /**
     * edit page
     *
     * @param $seller_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editSellerForm($seller_id)
    {
        return $this->sellerService->showEditSellerForm($seller_id);
    }

    /**
     * Edit seller
     *
     * @param Request $request
     * @param $seller_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editSeller(Request $request,$seller_id)
    {
      return $this->sellerService->editSellerDetails($request, $seller_id);
    }

}
