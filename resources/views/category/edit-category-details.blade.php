<x-layout>
@section('description', '')
    <div class="container">
        <h1>Edit Category Details</h1>
        <a href="/manage-products/">&laquo; Back to Manage Products</a>
        <form action="/edit-category/{{$category->slug}}" method="POST">
            @csrf
            <div class="form-item">
                <label for="name-edit">Category Name</label>
                <input required value="{{$category->name}}" name="name" id="name-edit" type="text" placeholder="Enter category name" />
                @error('name')
                <p class="form-error">{{$message}}</p>
                @enderror
            </div>

            <input value="{{$category->id}}" name="id" id="category-id" type="hidden" />

            <button type="submit">Save</button>
        </form>
    </div>
</x-layout>