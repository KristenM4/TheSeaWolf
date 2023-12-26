<x-layout>
    <div class="container">
        <h1>Create a New Product</h1>
        <form action="/create-product/" method="POST">
            @csrf
            <div class="form-item">
                <label for="name-create">Product Name</label>
                <input value="{{old('name')}}" name="name" id="name-create" type="text" placeholder="Enter product name" />
                @error('name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="description-create">Description</label>
                <textarea value="{{old('description')}}" name="description" id="description-create" rows="6" placeholder="Enter product description"></textarea>
                @error('description')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <button type="submit">Create Product</button>
        </form>
    </div>
</x-layout>