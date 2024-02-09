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
                        <a href="/change-product-image/{{$product->id}}/" title="Change image">Change image</a>
                        <a href="/edit-product/{{$product->id}}/" title="Edit details">Edit details</a>
                        <button class="delete-product" title="Delete product">Delete
                        <div class="delete-section">
                            <p>Are you sure you want to delete this product? This action cannot be undone.</p>
                            <a href="/delete-product/{{$product->id}}/">Delete</a>
                        </div>
                        </button>
                    </div>
                </td>
                <td>{{$product->price}}</td>
                <td>{{$product->discount}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</x-layout>