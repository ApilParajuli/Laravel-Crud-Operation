@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')
    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-header">Shop Products</div>
                    <div class="card-deck">
                        @foreach($products as $product)

                            <div class="col-sm p-2">
                                <div class="card border-primary mb-3" style="width: 20rem; text-align:center;">
                                    <div class="card-header "><h3>{{ $product->product_type }}</h3></div>
                                    <div class="card-body text-primary">

                                        <h5 class="card-title">{{ $product->title }}</h5>

                                        @if ($product->user->is(Auth::user()))
                                            <div style="font-size:1rem;" class="d-flex justify-content-between">
                                                <a href="{{ route('shopProduct.edit', $product) }}"
                                                   class="text-decoration-none">
                                                    <button
                                                        type="button" class="btn btn-dark">Edit / Show
                                                    </button>
                                                </a>
                                                <form action="{{ route('shopProduct.destroy', $product) }}"
                                                      method="POST">
                                                    @method("DELETE")
                                                    @csrf
                                                    <input value="Delete" type="submit" class="btn btn-danger">
                                                </form>
                                            </div>
                                        @else
                                            <a href="{{ route('shopProduct.show', $product) }}"
                                               class="text-decoration-none">
                                                <button
                                                    type="button" class="btn btn-primary btn-outline-dark">Show
                                                </button>
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div><br>
    {{ $products->links() }}
    <div class="p-5"></div>
@endsection
