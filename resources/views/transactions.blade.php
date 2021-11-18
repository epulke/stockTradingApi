<h1>My Transactions</h1>

<ul>
    @foreach ($transactions as $transaction)
        <li>
            <p>{{ $transaction->transaction_type }} {{ $transaction->stock_symbol }}, {{ $transaction->stock_price }}</p>

        </li>
    @endforeach
</ul>
