<x-layout>
    <div class="container single-product-page">
        <!-- Product image will go here -->
        <div class="single-product-image">
            <img src="{{$product->image_path}}" alt="{{$product->name}}">
        </div>
        <div class="single-product-info">
            <h1>{{$product->name}}</h1>
            <p>{!! $product->description !!}</p>
        </div>
    </div>
</x-layout>