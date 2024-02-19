<x-layout>
@section('description', 'The Sea Wolf Surf and Diving Shop is the best place in the UK to get your surfing and diving equipment.')
        <div class="homepage-hero">
            <div class="container">
                <h1>The Sea Wolf</h1>
                <p>Surf and Diving Shop</p>
            </div>
        </div>

        <div class="container">
        @auth
        <h2>You are logged in, {{auth()->user()->email}}</h2>
            @if(auth()->user()->staff)
            <a href="/manage-products/">Manage Products</a>
            @endif
        @else
        <div class="login-container">
            <h2>Log In</h2>
            <form action="/login/" method="POST" id="login-form">
            @csrf
                <div class="form-item">
                    <label for="email-login">Email Address</label>
                    <input value="{{old('email')}}" name="email-login" id="email-login" type="email" placeholder="Enter your email address" />
                    @error('email')
                    <p class="form-error">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-item">
                    <label for="password-login">Password</label>
                    <input name="password-login" id="password-login" type="password" placeholder="Enter a password" />
                    @error('password')
                    <p class="form-error">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit">Log In</button>
            </form>
            <p>Or <a href="/signup/">Sign Up</a></p>
        </div>
        @endauth
        @foreach($categories as $category)
        <div class="category-title">
            <h2 class="home-products-title">{{$category->name}}</h2>
            <a href="/category/{{$category->slug}}/" title="See All" style="padding-bottom:5px;">See All</a>
        </div>
        <div class="home-products">
            @foreach ($category->products as $product)
            <a href="/product/{{$product->slug}}/">
                <div class="home-product-card">
                    <img src="{{$product->image_path}}" alt="{{$product->name}}">
                    {{$product->name}}
                </div>
            </a>
            @endforeach
        </div>
        @endforeach
        <h2 class="home-products-title">All Products</h2>
        <div class="home-products">
            @foreach ($products as $product)
            <a href="/product/{{$product->slug}}/">
                <div class="home-product-card">
                    <img src="{{$product->image_path}}" alt="{{$product->name}}">
                    {{$product->name}}
                </div>
            </a>
            @endforeach
        </div>
        {{$products->links()}}
    </div>
</x-layout>