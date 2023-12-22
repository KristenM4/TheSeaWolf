<x-layout>
    <div class="container">
        <h1>Welcome to the signup page</h1>
        <form action="signup" method="POST" id="signup-form">
            @csrf
            <label for="firstname-signup">First Name</label>
            <input name="firstname" id="firstname-signup" type="text" placeholder="Enter your first name" />

            <label for="lastname-signup">Last Name</label>
            <input name="lastname" id="lastname-signup" type="text" placeholder="Enter your last name" />

            <label for="email-signup">Email Address</label>
            <input name="email" id="email-signup" type="email" placeholder="Enter your email address" />

            <label for="password-signup">Password</label>
            <input name="password" id="password-signup" type="password" placeholder="Enter a password" />

            <label for="password-signup-confirm">Confirm Password</label>
            <input name="password" id="password-signup-confirm" type="password" placeholder="Confirm password" />

            <button type="submit">Sign Up</button>
        </form>
    </div>
</x-layout>