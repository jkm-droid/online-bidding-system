<h5>Bid Products</h5>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Bid Price</th>
            <th>Bid Time</th>
            <th>Is Closed</th>
            <th>Expired At</th>
            <th>Bid Success</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($buyer_bid_products as $bid_product)
            <tr>
                <td><i class="fas fa-check-square"></i></td>
                <td>{{ $bid_product->product->product_name }}</td>
                <td>{{ $bid_product->product->price }}</td>
                <td>{{ $bid_product->bid_price }}</td>
                <td>{{ $bid_product->created_at }}</td>
                <td class="text-center">
                    @if($bid_product->product->is_closed)
                        <i class="fa fa-check-circle text-success"></i>
                    @else
                        <i class="fa fa-times-circle text-danger"></i>
                    @endif
                </td>
                <td>{{ $bid_product->product->updated_at }}</td>
                <td class="text-center">
                    @if($bid_product->is_success)
                        <i class="fa fa-check-circle text-success"></i>
                    @else
                        <i class="fa fa-times-circle text-danger"></i>
                    @endif
                </td>
                <td>
                    <a href="">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center paginate-mobile">
    {{ $buyer_bid_products->links('pagination.custom_pagination') }}
</div>
