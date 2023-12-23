<x-layout>
    <div class="container signup-form-container">
        <h1>Sign Up</h1>
        <form action="/signup-success" method="POST" id="signup-form">
            @csrf
            <div class="form-item">
                <label for="firstname-signup">First Name</label>
                <input name="first_name" id="firstname-signup" type="text" placeholder="Enter your first name" />
            </div>

            <div class="form-item">
            <label for="lastname-signup">Last Name</label>
            <input name="last_name" id="lastname-signup" type="text" placeholder="Enter your last name" />
            </div>

            <div class="form-item">
            <label for="email-signup">Email Address</label>
            <input name="email" id="email-signup" type="email" placeholder="Enter your email address" />
            </div>

            <div class="form-item">
            <label for="password-signup">Password</label>
            <input name="password" id="password-signup" type="password" placeholder="Enter a password" />
            </div>

            <div class="form-item">
            <label for="password-signup-confirm">Confirm Password</label>
            <input name="password" id="password-signup-confirm" type="password" placeholder="Confirm password" />
            </div>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</x-layout>