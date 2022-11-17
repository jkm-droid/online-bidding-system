<div class="mt-3">
    <h4 class="mt-4">Similar Products</h4>
    @if(count($similarProducts) > 0)
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($similarProducts as $product)
                <div class="col">
                    <div class="card h-100">
                        <img src="/product_gallery/{{ $product->product_image }}" style="min-height: 400px;max-height: 400px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->product_name }}
                            </h5>
                            <h5 class="card-title badge badge-success">
                                {{ $product->price }}
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

                        <div class="card-footer text-center">
                            <a href="#" data-toggle="modal" data-target="#bidModal{{$product->id}}" class="btn btn-primary">Place Bid</a>

                            @include('buyer.auction_center.partials.bidding-modal')

                            <a class="btn btn-success">
                                View More Product & Seller details
                            </a>
                        </div>

                    </div>
                </div>

            @endforeach
        </div>
    @endif
</div>

<div class="mt-3">
    <h4 class="mt-4">Products</h4>
    @if(count($products) > 0)
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100">
                        <img src="/product_gallery/{{ $product->product_image }}" style="min-height: 400px;max-height: 400px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->product_name }}
                            </h5>
                            <h5 class="card-title badge badge-success">
                                {{ $product->price }}
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

                        <div class="card-footer text-center">
                            <a href="#" data-toggle="modal" data-target="#bidModal{{$product->id}}" class="btn btn-primary">Place Bid</a>

                            @include('buyer.auction_center.partials.bidding-modal')

                            <a class="btn btn-success">
                                View More Product & Seller details
                            </a>
                        </div>

                    </div>
                </div>

            @endforeach
        </div>
    @else
        <p class="alert alert-danger">Oops! No products were found</p>
    @endif
</div>

<div class="d-flex justify-content-center paginate-mobile">
    {{ $products->links('pagination.custom_pagination') }}
</div>
