<x-layout>
@section('title', 'Your Cart')
@section('description', 'Your Cart - The Sea Wolf Surf and Diving Shop')
    <div class="container cart-page">
        @if($cartitems)
        <h1>Your Cart</h1>
            @foreach($cartitems as $item)
            <div class="cart-item">
                <div class="cart-item-info">
                    {{$item['product']->name}}
                    <a href="/product/{{$item['product']->slug}}/">View store page</a>
                </div>
                <div class="cart-item-info">
                    <div>&#163;{{$item['product']->totalPrice}}</div>
                    <div>qty: {{$item['quantity']}}</div>
                </div>
            </div>
            @endforeach
        @else
        <h1>Your cart is empty!<h1>
        @endif
    </div>
</x-layout>