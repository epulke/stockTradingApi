<h1>My Portfolio</h1>

<ul>
    @foreach ($stocks as $stock)
        <li>
            <p>{{ $stock->stock_symbol }}, {{ $stock->purchase_price }}</p>

        </li>
    @endforeach
</ul>
