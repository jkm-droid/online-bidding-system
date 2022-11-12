<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Specs</th>
            <th>Is Available</th>
            <th>Created On</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td><i class="fas fa-check-square"></i></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->specs }}</td>
                <td>{{ $product->is_available }}</td>
                <td>{{ $product->created_at }}</td>
                <td>
                    <a href="{{ route('admin.product.edit.form', $product->id) }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
