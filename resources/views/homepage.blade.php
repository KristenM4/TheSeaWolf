<x-layout>
    <div class="container">
        <h1>Welcome to the home page</h1>

        <div class="login-container">
            <h2>Log In</h2>
            <form action="/" method="POST" id="login-form">
            @csrf
                <div class="form-item">
                    <label for="email-login">Email Address</label>
                    <input value="{{old('email')}}" name="email" id="email-login" type="email" placeholder="Enter your email address" />
                    @error('email')
                    <p class="form-error">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-item">
                    <label for="password-login">Password</label>
                    <input name="password" id="password-login" type="password" placeholder="Enter a password" />
                    @error('password')
                    <p class="form-error">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit">Log In</button>
            </form>
            <p>Or <a href="/signup/">Sign Up</a></p>
        </div>
    </div>
</x-layout>