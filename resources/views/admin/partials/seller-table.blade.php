<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Location</th>
            <th>Created On</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sellers as $seller)
            <tr>
                <td><i class="fas fa-check-square"></i></td>
                <td>{{ $seller->full_name }}</td>
                <td>{{ $seller->email }}</td>
                <td>{{ $seller->phone_number }}</td>
                <td>{{ $seller->location }}</td>
                <td>{{ $seller->created_at }}</td>
                <td>
                    <a href="{{ route('admin.seller.edit.form', $seller->id) }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
