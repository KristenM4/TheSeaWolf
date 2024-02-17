<x-layout>
    <div class="container">
        <h1>Edit Product Details</h1>
        <a href="/manage-products/">&laquo; Back to Manage Products</a>
        <form action="/edit-product/{{$product->slug}}" method="POST">
            @csrf
            <div class="form-item">
                <label for="name-edit">Product Name</label>
                <input required value="{{$product->name}}" name="name" id="name-edit" type="text" placeholder="Enter product name" />
                @error('name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="description-edit">Description</label>
                <textarea required name="description" id="description-edit" rows="6" placeholder="Enter product description">{{$product->description}}</textarea>
                @error('description')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="price-edit">Price in GBP</label>
                <input required step=".01" value="{{$product->price}}" name="price" id="price-edit" type="number" placeholder="Enter price" />
                @error('price')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="discount-edit">Discount Percentage</label>
                <input step=".01" value="{{$product->discount}}" name="discount" id="discount-edit" type="number" placeholder="Enter discount percentage" />
                @error('discount')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="category-edit">Category</label>
                <select name="category" id="category-edit">
                    <option value="{{$product->category_id}}">
                        @if($productCategory == null)
                        None
                        @else
                        {{$productCategory->name}}
                        @endif
                    </option>
                    @foreach($otherCategories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>
            <input value="{{$product->id}}" name="id" id="product-id" type="hidden" />

            <button type="submit">Save</button>
        </form>
    </div>
</x-layout>