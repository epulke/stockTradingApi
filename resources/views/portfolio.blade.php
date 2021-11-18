<h1>My Portfolio</h1>

<ul>
    @foreach ($portfolio as $entry)
        <li>
            <p>{{ $entry->getUserStock()->stock_symbol }}, {{ $entry->getUserStock()->amount }}, {{ $entry->getUserStock()->purchase_value }}</p>
            <p>{{ $entry->getCurrentValue() }}, {{ $entry->getProfitLoss() }}</p>
            <p>{{ $entry->getQuote()->quote }}</p>


        </li>
    @endforeach
</ul>
