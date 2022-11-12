<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ManageProductController extends Controller
{
    /**
     * @var productService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Get products
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getProducts()
    {
        return $this->productService->getProducts();
    }

    /**
     * Create product page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addNewProductForm()
    {
        return $this->productService->showCreateProductForm();
    }

    /**
     * Add new seller
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewProduct(Request $request)
    {
      return $this->productService->createNewProduct($request);
    }

    /**
     * edit page
     *
     * @param $product_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editProductForm($product_id)
    {
        return $this->productService->showEditProductForm($product_id);
    }

    /**
     * Edit seller
     *
     * @param Request $request
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editProduct(Request $request,$product_id)
    {
      return $this->productService->editProductDetails($request, $product_id);
    }

}
