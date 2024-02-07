<x-layout>
    <div class="container manage-product-page">
        <h1>Manage Products</h1>
        <a href="/create-product/">New Product</a>
        <h3>All Products</h3>
        <table class="manage-products-table">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Discount</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->discount}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</x-layout>