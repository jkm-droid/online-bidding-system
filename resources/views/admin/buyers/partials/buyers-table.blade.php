<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Profile</th>
            <th>Phone Number</th>
            <th>Created On</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($buyers as $buyer)
            <tr>
                <td><i class="fas fa-check-square"></i></td>
                <td>{{ $buyer->full_name }}</td>
                <td>{{ $buyer->email }}</td>
                <td class="text-center">
                    <img src="/profile_pictures/{{$buyer->profile_url}}" alt="" width="70" height="35">
                </td>
                <td>{{ $buyer->phone_number }}</td>
                <td>{{ $buyer->created_at }}</td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center paginate-mobile">
    {{ $buyers->links('pagination.custom_pagination') }}
</div>
