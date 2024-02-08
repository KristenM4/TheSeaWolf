<x-layout>
    <div class="container change-product-image-page">
        <div>
            <h1>Change Product Image</h1>
            <h2>{{$product->name}}</h2>
        </div>

        <div>
            <img src="{{$product->image_path}}" alt="{{$product->name}}">
            <p>Current Image</p>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="form-item">
                <label for="image-change">New Image</label>
                <input required value="{{old('image')}}" name="image" id="image-change" type="file" accept="image/*" />
                @error('image')
                <p class="form-error">{{$message}}</p>
                @enderror
                <input value="{{$product->id}}" name="id" id="product-id" type="hidden" />
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</x-layout>