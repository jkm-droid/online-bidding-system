<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Specs</th>
            <th>Is Available</th>
            <th>Owner</th>
            <th>Bids</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td><i class="fas fa-check-square"></i></td>
                <td>{{ $product->product_name }}</td>
                <td>
                    <img src="/product_gallery/{{$product->product_image}}" alt="" width="70" height="35">
                </td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->specs }}</td>
                <td class="text-center">
                    @if($product->is_available)
                        <i class="fa fa-check-circle text-success"></i>
                    @else
                        <i class="fa fa-times-circle text-danger"></i>
                    @endif
                </td>
                <td>{{ $product->seller->email }}</td>
                <td>{{ $product->bids->count() }}</td>
                <td>
                    <a href="{{ route('admin.product.edit.form', $product->id) }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
