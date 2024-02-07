<x-layout>

        <div class="homepage-hero">
            <div class="container">
                <h1>The Sea Wolf</h1>
                <p>Surf and Diving Shop</p>
            </div>
        </div>

        <div class="container">
        @auth
        <h2>You are logged in, {{auth()->user()->email}}</h2>
            <a href="/manage-products/">Manage Products</a>
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
        <h2 class="home-products-title">All Products</h2>
        <div class="home-products">
            @foreach ($products as $product)
            <a href="/product/{{$product->id}}"><div class="home-product-card">
                {{$product->name}}
            </div></a>
            @endforeach
        </div>
    </div>
</x-layout>