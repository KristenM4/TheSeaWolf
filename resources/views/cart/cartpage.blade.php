<x-layout>
@section('title', 'Your Cart')
@section('description', 'Your Cart - The Sea Wolf Surf and Diving Shop')
    <div class="container cart-page">
        <h1>Your Cart</h1>
        @if(!$cartitems)
        <h2>Your cart is empty!</h2>
        @else
            @foreach($cartitems as $item)
            <div class="cart-item">
                <div class="cart-item-info">
                    {{$item['product']->name}}
                    <a href="/product/{{$item['product']->slug}}/">View store page</a>
                </div>
                <div class="cart-item-info">
                    <div>&#163;{{$item['product']->totalPrice}}</div>
                    <div>
                        <a href="/cart-item-plus/{{$item['product']->slug}}/">plus</a>
                        qty: {{$item['quantity']}}
                        <a href="/cart-item-minus/{{$item['product']->slug}}/">minus</a>
                        <a href="/cart-item-delete/{{$item['product']->slug}}/">delete</a>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</x-layout>