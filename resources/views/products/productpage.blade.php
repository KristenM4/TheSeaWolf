<x-layout>
    <div class="container single-product-page">
        <!-- Product image will go here -->
        <div class="single-product-image">
            <img src="{{$product->image_path}}" alt="{{$product->name}}">
        </div>
        <div class="single-product-info">
            <div>
                <h1>{{$product->name}}</h1>
                @if($product->discount > 0.00)
                <div class="discounted-product">
                    <h3><span style="text-decoration:line-through;">&#163;{{$product->price}}</span> &#163;{{$product->totalPrice}}</h3>
                    <h4 class="discounted-percentage">{{$product->discount * 100}}% off!</h4>
                </div>
                @else
                <h3>&#163;{{$product->totalPrice}}</h3>
                @endif
            </div>
            <p>{!! $product->description !!}</p>
        </div>
    </div>
</x-layout>