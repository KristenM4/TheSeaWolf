<x-layout>
@section('title', auth()->user()->first_name . "'s Profile")
@section('description', 'View and edit your user details here.')
    <div class="container">
        <h1>Your Profile</h1>
        <p>Email: {{auth()->user()->email}}</p>
        <p>First Name: {{auth()->user()->first_name}}</p>
        <p>Last Name: {{auth()->user()->last_name}}</p>
        <a href="/edit-user/">Edit User Details</a>
    </div>
</x-layout>