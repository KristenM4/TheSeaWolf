<x-layout>
@section('description', 'Change and edit your account details here.')
    <div class="container">
        <h1>Edit User Details</h1>
        <a href="/user-profile/">&laquo; Back to My Profile</a>
        <form action="/edit-user/" method="POST">
            @csrf
            <div class="form-item">
                <label for="firstname-edit">First Name</label>
                <input required value="{{auth()->user()->first_name}}" name="first_name" id="firstname-edit" type="text" placeholder="Enter your first name" />
                @error('first_name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>
            <div class="form-item">
                <label for="lastname-edit">Last Name</label>
                <input required value="{{auth()->user()->last_name}}" name="last_name" id="lastname-edit" type="text" placeholder="Enter your last name" />
                @error('last_name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>
            <div class="form-item">
                <label for="email-edit">Email Address</label>
                <input required value="{{auth()->user()->email}}" name="email" id="email-edit" type="text" placeholder="Enter your email address" />
                @error('email')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</x-layout>