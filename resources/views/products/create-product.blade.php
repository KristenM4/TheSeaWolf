<x-layout>
    <div class="container">
        <h1>Create a New Product</h1>
        <form action="/create-product/" method="POST" enctype="multipart/form-data">
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

            <div class="form-item">
                <label for="price-create">Price in GBP</label>
                <input required step=".01" value="{{old('price')}}" name="price" id="price-create" type="number" placeholder="Enter price" />
                @error('price')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="discount-create">Discount Percentage (0.00 by default)</label>
                <input step=".01" value="{{old('discount')}}" name="discount" id="discount-create" type="number" placeholder="Enter discount percentage" />
                @error('discount')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="image-create">Product Image</label>
                <input required value="{{old('image')}}" name="image" id="image-create" type="file" accept="image/*" />
                @error('image')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <button type="submit">Create Product</button>
        </form>
    </div>
</x-layout>