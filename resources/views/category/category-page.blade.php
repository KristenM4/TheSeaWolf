<x-layout>

        <div class="container">
        <h2 class="home-products-title">{{$category->name}}</h2>
        <div class="home-products">
            @foreach ($products as $product)
            <a href="/product/{{$product->id}}">
                <div class="home-product-card">
                    <img src="{{$product->image_path}}" alt="{{$product->name}}">
                    {{$product->name}}
                </div>
            </a>
            @endforeach
        </div>
    </div>
</x-layout>