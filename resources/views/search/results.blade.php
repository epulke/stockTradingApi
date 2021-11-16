<h1>Search Results</h1>

<ul>
    @foreach ($stocks as $stock)
        <li>
            <a href="/companies/{{ $stock->symbol }}">{{ $stock->name }}, {{ $stock->symbol }}</a>

        </li>
    @endforeach
</ul>


