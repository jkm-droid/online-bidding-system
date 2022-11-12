@extends('base.dashboard_portal')

@section('content')

    <div style="--bs-breadcrumb-divider: '>';" class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb bg-light mb-0 text-gray-800" >
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
        </ol>
    </div>

    <div class="col-md-12">

        @if ($message = Session::get('error'))
            <p class="alert alert-danger">{{ $message }}</p>
        @endif
        <form action="{{ route('admin.product.add') }}" method="post">
            @csrf

            <div class="col-md-12 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" placeholder="Product name">
                @if ($errors->has('product_name'))
                    <div class="text-danger form-text"><small>{{ $errors->first('product_name') }}</small></div>
                @endif
            </div>

            <div class="col-md-12 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" value="{{ old('price') }}" placeholder="Price">
                @if ($errors->has('price'))
                    <div class="text-danger form-text"><small>{{ $errors->first('price') }}</small></div>
                @endif
            </div>

            <div class="col-md-12 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Product Owner(Seller)</label>
                <select name="product_owner" class="form-select form-control" aria-label="Default select example" autofocus>
                <option value="" disabled selected>Select Product Owner</option>
                @foreach($sellers as $seller)
                    <option value="{{ $seller->id }}">{{ $seller->full_name }}({{ $seller->email }})</option>
                @endforeach
                </select>

                @if ($errors->has('product_owner'))
                    <div class="text-danger form-text"><small>{{ $errors->first('product_owner') }}</small></div>
                @endif
            </div>

            <div class="row g-3 mt-3 col-md-12" id="extra-equipment">
                <div class="col-md-12" id="input-field-equipment">
                </div>
            </div>

            <div class="col-md-12">
                <button id="add-extra-equipment" class="btn btn-info btn-sm mt-2"><i class="fa fa-plus"></i> Add Features</button>
                <script>
                    $(document).on('click', '#add-extra-equipment',function(e) {
                        e.preventDefault();

                        const equipmentDiv = document.getElementById('input-field-equipment');
                        const  equipment = document.createElement("input");
                        equipment.setAttribute("type", "text");
                        equipment.setAttribute("name", "feature_name[]");
                        equipment.setAttribute("placeholder", "eg 500 HDD storage");
                        equipment.setAttribute("class", "form-control");

                        $('#input-field-equipment').append('<label class="form-label">Feature Name</label>');
                        equipmentDiv.appendChild(equipment);

                    });

                </script>
                <div>
                    <button type="submit" class="btn btn-secondary mt-2">Add Product</button>
                </div>
            </div>

        </form>

    </div>
@endsection
