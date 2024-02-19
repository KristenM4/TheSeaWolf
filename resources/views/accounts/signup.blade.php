<x-layout>
@section('description', 'Create a customer account on The Sea Wolf to get the best prices in the UK on surfing and diving equipment.')
    <div class="container signup-form-container">
        <h1>Sign Up</h1>
        <form action="/signup-success" method="POST" id="signup-form">
            @csrf
            <div class="form-item">
                <label for="firstname-signup">First Name</label>
                <input value="{{old('first_name')}}" name="first_name" id="firstname-signup" type="text" placeholder="Enter your first name" />
                @error('first_name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="lastname-signup">Last Name</label>
                <input value="{{old('last_name')}}" name="last_name" id="lastname-signup" type="text" placeholder="Enter your last name" />
                @error('last_name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="email-signup">Email Address</label>
                <input value="{{old('email')}}" name="email" id="email-signup" type="email" placeholder="Enter your email address" />
                @error('email')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="password-signup">Password</label>
                <input name="password" id="password-signup" type="password" placeholder="Enter a password" />
                @error('password')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="password-signup-confirm">Confirm Password</label>
                <input name="password_confirmation" id="password-signup-confirm" type="password" placeholder="Confirm password" />
                @error('password_confirmation')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</x-layout>