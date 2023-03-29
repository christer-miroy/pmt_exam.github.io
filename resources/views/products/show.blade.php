@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="titlebar">
                    <h1>Product Info</h1>
                    <a href="{{ route('products.index') }}" class="btn-link">Back</a>
                </div>
                @if ($errors->any)
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" disabled>
                        <label>Description (optional)</label>
                        <textarea cols="10" rows="5" name="description" value="{{ $product->description }}" disabled>{{ $product->description }}</textarea>
                        <label>Add Image</label>
                        <img src="{{ asset('images/' . $product->image) }}" alt="" class="img-product"
                            id="file-preview" />
                    </div>
                    <div>
                        <label>Category</label>
                        <select name="category" id="">
                            @foreach (json_decode('{"Smartphone":"Smart Phone","SmartTV":"Smart TV", "Computer":"Computer"}', true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}" disabled>{{ $optionValue }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label>Inventory</label>
                        <input type="text" name="quantity" value="{{ $product->quantity }}" disabled>
                        <hr>
                        <label>Price</label>
                        <input type="text" name="price" value="{{ $product->price }}" disabled>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
