<x-layout>
    <div class="container">
        <h1>Create a New Category</h1>
        <form action="/create-category/" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-item">
                <label for="name-create">Category Name</label>
                <input required value="{{old('name')}}" name="name" id="name-create" type="text" placeholder="Enter category name" />
                @error('name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <button type="submit">Create Category</button>
        </form>
    </div>
</x-layout>