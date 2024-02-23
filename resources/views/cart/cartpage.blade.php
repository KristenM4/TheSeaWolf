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
                <div class="cart-info-and-icons">
                    <div class="cart-item-info">
                        <div>&#163;{{$item['product']->totalPrice}}</div>
                        <div class="cart-icons-section">
                            <a href="/cart-item-minus/{{$item['product']->slug}}/"><img class="icon-in-cart" src="{{url('/images/minus.svg')}}" alt="A minus sign"></a>
                            <span class="quantity">{{$item['quantity']}}</span>
                            <a href="/cart-item-plus/{{$item['product']->slug}}/"><img class="icon-in-cart" src="{{url('/images/plus.svg')}}" alt="A plus sign"></a>

                        </div>
                    </div>
                    <a href="/cart-item-delete/{{$item['product']->slug}}/" title="Remove"><img class="trash-icon-in-cart" src="{{url('/images/trash.svg')}}" alt="A trash can icon"></a>
                </div>
            </div>
            @endforeach
            <p>TOTAL &#163;{{$total}}</p>
        @endif
    </div>
</x-layout>