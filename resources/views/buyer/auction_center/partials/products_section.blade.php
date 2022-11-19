<div class="mt-3">
    @if(count($similarProducts) > 0)
        <h4 class="mt-4 text-danger">Similar Products</h4>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($similarProducts as $product)
{{--                <div class="col">--}}
                    <div class="card h-100 border-danger">
                        <img src="/product_gallery/{{ $product->product_image }}" style="min-height: 400px;max-height: 400px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->product_name }}
                                @if($product->is_closed == 1)
                                    <span class="badge badge-danger"><small class="font-weight-bold">closed</small></span>
                                @endif
                            </h5>
                            <h5 class="card-title badge badge-success">
                                {{ number_format($product->price,2)  }}
                            </h5>
                            <h5 class="card-title badge badge-dark">
                                {{ $product->bids->count() }} bids
                            </h5>
                            <div class="card-text">
                                <h5 class=""><u>Specs</u></h5>
                                @foreach(explode(",",$product->specs) as $spec)
                                    <li>{{ $spec }}</li>
                                @endforeach

                                <h5 class="mt-1"><u>Seller</u></h5>
                                <li style="color: black; font-weight: bolder">{{ $product->seller->full_name }}</li>
                                <li><i class="fa fa-star text-info"></i>{{ $product->seller->rating }}</li>
                            </div>
                        </div>

                        @if($product->is_closed == 0)
                            <div class="card-footer text-center">
                                <a href="#" data-toggle="modal" data-target="#bidModal{{$product->id}}" class="btn btn-primary">Place Bid</a>

                                @include('buyer.auction_center.partials.bidding-modal')
                            </div>
                        @endif

                    </div>
{{--                </div>--}}
            @endforeach
        </div>
    @endif
        <div class="d-flex justify-content-center paginate-mobile">
            {{ $similarProducts->links('pagination.custom_pagination') }}
        </div>
</div>

<div class="mt-3">
    @if(count($products) > 0)
        <h4 class="mt-4">Products</h4>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($products as $product)
                <div class="col mt-4">
                    <div class="card h-100">
                        <img src="/product_gallery/{{ $product->product_image }}" style="min-height: 400px;max-height: 400px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->product_name }}
                                @if($product->is_closed == 1)
                                    <span class="badge badge-danger"><small class="font-weight-bold">closed</small></span>
                                @endif
                            </h5>
                            <h5 class="card-title badge badge-success">
                                {{ number_format($product->price,2) }}
                            </h5>
                            <h5 class="card-title badge badge-dark">
                                {{ $product->bids->count() }} bids
                            </h5>
                            <div class="card-text">
                                <h5 class=""><u>Specs</u></h5>
                                @foreach(explode(",",$product->specs) as $spec)
                                    <li>{{ $spec }}</li>
                                @endforeach

                                <h5 class="mt-1"><u>Seller</u></h5>
                                <li style="color: black; font-weight: bolder">{{ $product->seller->full_name }}</li>
                                <li><i class="fa fa-star text-info"></i>{{ $product->seller->rating }}</li>
                            </div>
                        </div>

                        @if($product->is_closed == 0)
                            <div class="card-footer text-center">
                                <a href="#" data-toggle="modal" data-target="#bidModal{{$product->id}}" class="btn btn-primary">Place Bid</a>

                                @include('buyer.auction_center.partials.bidding-modal')
                            </div>
                        @endif

                    </div>
                </div>

            @endforeach
        </div>
    @else
        <p class="alert alert-danger text-center">Oops! No products were found</p>
    @endif
</div>

<div class="d-flex justify-content-center paginate-mobile">
    {{ $products->links('pagination.custom_pagination') }}
</div>
