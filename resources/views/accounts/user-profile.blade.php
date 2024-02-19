<x-layout>
@section('description', 'View and edit your user details here.')
    <div class="container">
        <h1>Your Profile</h1>
        <p>Email: {{auth()->user()->email}}</p>
        <p>First Name: {{auth()->user()->first_name}}</p>
        <p>Last Name: {{auth()->user()->last_name}}</p>
    </div>
</x-layout>