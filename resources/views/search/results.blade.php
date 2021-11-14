<h1>Search Results</h1>

<ul>
    @foreach ($stocks as $stock)
        <li>
            <p> {{ $stock->name }}, {{ $stock->symbol }}</p>
        </li>
    @endforeach
</ul>


