<x-layout>
    <div class="container">
        <h1>Your Profile</h1>
        <p>Email: {{$user->email}}</p>
        <p>First Name: {{$user->first_name}}</p>
        <p>Last Name: {{$user->last_name}}</p>
    </div>
</x-layout>