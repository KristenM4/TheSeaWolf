<x-layout>
    <div class="container manage-product-page">
        <h1>Manage Products</h1>
        <a href="/create-product/">New Product</a>
        <h3>All Products</h3>
        <table class="manage-products-table">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Discount</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>
                    <img src="{{$product->image_path}}" alt="{{$product->name}}">
                    <div>
                        {{$product->name}}
                        @can('update', $product)
                        <a href="/change-product-image/{{$product->id}}/" title="Change image">Change image</a>
                        <a href="/edit-product/{{$product->id}}/" title="Edit details">Edit details</a>
                        @endcan
                        @can('delete', $product)
                        <button class="delete-product" title="Delete product">Delete
                        <div class="delete-section">
                            <p>Are you sure you want to delete this product? This action cannot be undone.</p>
                            <a href="/delete-product/{{$product->id}}/">Delete</a>
                        </div>
                        </button>
                        @endcan
                    </div>
                </td>
                <td>{{$product->price}}</td>
                <td>{{$product->discount}}</td>
            </tr>
            @endforeach
        </table>
        <h3>All Categories</h3>
        <a href="/create-category/">New Category</a>
        <table class="manage-products-table">
            <tr>
                <th>Name</th>
                <th>No. of Products</th>
            </tr>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>
                    @php
                        $numProducts = App\Models\Product::where('category_id', $category->id)->count();
                    @endphp
                    {{$numProducts}}
                </td>
            </tr>
            @endforeach
            <tr>
                <td>No Category</td>
                <td>
                    @php
                        $uncategorizedProducts = App\Models\Product::where('category_id', 0)->count();
                    @endphp
                    {{$uncategorizedProducts}}
                </td>
            </tr>
    </table>
    </div>
</x-layout>