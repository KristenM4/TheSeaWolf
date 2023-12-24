<x-layout>
    <div class="container">
        <h1>Welcome to the home page</h1>

        @auth
        <h2>You are logged in</h2>
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
    </div>
</x-layout>