<x-layout>
@section('description', 'Find your favorite surfing and diving products at The Sea Wolf.')
        <div class="container">
        <h2 class="home-products-title">{{$category->name}}</h2>
        <h3>{{$category->numProducts}} found</h3>
        <div class="home-products">
            @foreach ($products as $product)
            <a href="/product/{{$product->slug}}">
                <div class="home-product-card">
                    <img src="{{$product->image_path}}" alt="{{$product->name}}">
                    {{$product->name}}
                </div>
            </a>
            @endforeach
        </div>
    </div>
</x-layout>