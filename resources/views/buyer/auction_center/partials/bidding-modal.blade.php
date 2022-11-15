<div class="modal fade" id="bidModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do you really want to place this bid?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Please fill in all the fields</p>
                <form action="{{ route('buyer.products.place.bid') }}" method="post">
                    @csrf
                    <input type="hidden" class="form-control" name="product_id" value="{{ $product->id }}">

                    <div class="mb-3">
                        <input type="text" class="form-control" name="bid_price" value="{{ $product->price }} (current bid price)" readonly>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="bid_price" placeholder="Bidding price">
                        @if ($errors->has('bid_price'))
                            <div class="text-danger form-text"><small>{{ $errors->first('bid_price') }}</small></div>
                        @endif
                    </div>
                    <div class=" mb-3">
                        <input type="text" class="form-control" name="bid_comment" placeholder="Comment">
                        @if ($errors->has('bid_comment'))
                            <div class="text-danger form-text"><small>{{ $errors->first('bid_comment') }}</small></div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary form-control text-uppercase">Place Bid</button>
                </form>
            </div>
        </div>
    </div>
</div>
