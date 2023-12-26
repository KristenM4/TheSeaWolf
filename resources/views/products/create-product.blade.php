<x-layout>
    <div class="container">
        <h1>Create a New Product</h1>
        <form action="/create-product/" method="POST">
            @csrf
            <div class="form-item">
                <label for="name-create">Product Name</label>
                <input required value="{{old('name')}}" name="name" id="name-create" type="text" placeholder="Enter product name" />
                @error('name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="description-create">Description</label>
                <textarea required name="description" id="description-create" rows="6" placeholder="Enter product description">{{old('description')}}</textarea>
                @error('description')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <button type="submit">Create Product</button>
        </form>
    </div>
</x-layout>