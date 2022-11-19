<h5>Bids</h5>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Bidder</th>
            <th>Product Price</th>
            <th>Bid Price</th>
            <th>Bid Time</th>
            <th>Has Expired</th>
            <th>Expired At</th>
            <th>Is Success</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bids as $bid)
            <tr>
                <td><i class="fas fa-check-square"></i></td>
                <td>{{ $bid->product->product_name }}</td>
                <td>
                    @if($bid->user)
                        {{ $bid->user->full_name }}
                    @endif
                </td>
                <td>{{ $bid->product->price }}</td>
                <td>{{ $bid->bid_price }}</td>
                <td>{{ $bid->created_at }}</td>
                <td class="text-center">
                    @if($bid->has_expired)
                        <i class="fa fa-check-circle text-success"></i>
                    @else
                        <i class="fa fa-times-circle text-danger"></i>
                    @endif
                </td>
                <td>{{ $bid->expired_at }}</td>
                <td class="text-center">
                    @if($bid->is_success)
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
    {{ $bids->links('pagination.custom_pagination') }}
</div>
