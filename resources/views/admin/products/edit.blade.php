@extends('base.dashboard_portal')

@section('content')

    <div style="--bs-breadcrumb-divider: '>';" class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb bg-light mb-0 text-gray-800" >
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
        </ol>
    </div>

    <div class="col-md-12">

        @if ($message = Session::get('error'))
            <p class="alert alert-danger">{{ $message }}</p>
        @endif
        <form action="{{ route('admin.product.edit', $product->id) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" placeholder="Product name">
                    @if ($errors->has('product_name'))
                        <div class="text-danger form-text"><small>{{ $errors->first('product_name') }}</small></div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" value="{{ $product->price }}" placeholder="Price">
                    @if ($errors->has('price'))
                        <div class="text-danger form-text"><small>{{ $errors->first('price') }}</small></div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Product Owner(Seller)</label>
                    <select name="product_owner" class="form-select form-control" aria-label="Default select example" autofocus>
                        <option disabled selected>Select Product Owner</option>
                        @foreach($sellers as $seller)
                            <option value="{{ $seller->id }}" {{ $seller->id == $product->seller_id ? 'selected' : '' }}>{{ $seller->full_name }}({{ $seller->email }})</option>
                        @endforeach
                    </select>

                    @if ($errors->has('product_owner'))
                        <div class="text-danger form-text"><small>{{ $errors->first('product_owner') }}</small></div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Product Image</label>
                    <input type="file" class="form-control" name="product_image" value="{{ old('product_image') }}" placeholder="Product Image">
                    @if ($errors->has('product_image'))
                        <div class="text-danger form-text"><small>{{ $errors->first('product_image') }}</small></div>
                    @endif
                </div>

            </div>

            <label for="exampleFormControlTextarea1" class="form-label">Product Features</label>
            <textarea type="text" class="form-control" name="feature_name" placeholder="Add comma separated features eg. 500gb hdd,8gb ram">
                {{ $product->specs }}
            </textarea>
            @if ($errors->has('feature_name'))
                <div class="text-danger form-text"><small>{{ $errors->first('feature_name') }}</small></div>
            @endif

            <div>
                <button type="submit" class="btn btn-secondary mt-2">Update Product</button>
            </div>

        </form>

    </div>
@endsection
