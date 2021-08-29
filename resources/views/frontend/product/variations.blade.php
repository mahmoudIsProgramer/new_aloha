<ul>
    @foreach ($product->listVariations() as $product_id => $variation)
        <li><a href="{{ route('product', ['product' => $product_id]) }}" class="@if ($product->id == $product_id) current @endif">
                {{ $variation }}</a>
    @endforeach
</ul>
