@extends("layouts.app")

@section("pageTitle", $pageTitle)

@section('content')
    <div class="container p-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header ">
                        <h4>{{ Str::ucfirst($product->title) }} {{ $product->product_type }} Details</h4></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productType">Product Type</label>
                            <input type="text" class="form-control" name="productType" id="productType"
                                   placeholder="Product Type" value="{{ $product->product_type }}">
                        </div>
                        <div class="form-group">
                            <label for="firstName">Author / Artist</label>
                        </div>

                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName"
                                   placeholder="First Name" value="{{ $product->first_name }}">

                        </div>
                        <div class="form-group">
                            <label for="firstName">Main Name / Surname / Console</label>
                            <input type="text" class="form-control" name="mainName" id="mainName"
                                   placeholder="Main Name / Surname / Console" value="{{ $product->main_name }}">

                        </div>
                        <div class="form-group">
                            <label for="firstName">Product Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title"
                                   value="{{ $product->title }}">
                        </div>
                        <div class="form-group">
                            <label for="firstName">Pages / Duration / PEGI</label>
                            <input type="text" class="form-control" name="uniqueField" id="uniqueField"
                                   placeholder="Pages / Duration / PEGI" value="{{ $uniqueFieldValue }}">
                        </div>
                        <div class="form-group">
                            <label for="firstName">Price</label>
                            <input type="text" class="form-control" name="price" id="price" placeholder="Price"
                                   value="{{ $product->price }}">

                        </div>
                        <div class="form-group ">

                            <a href="{{ route("shopProduct.index") }}" class="add-product btn btn-dark">Back</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-5"></div>
@endsection
