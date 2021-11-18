
<h1>{{ $company->name }}</h1>
<img src="{{ $company->logoUrl }}" alt="{{ $company->name }} logo">
<h5>{{ $company->symbol }}</h5>
<h5>Currency: {{ $company->currency }}</h5>
<h5>Company Industry: {{ $company->industry }}</h5>
<h5>Website: {{ $company->webUrl }}</h5>
<h5>Market Capitalization {{ $company->marketCapitalization }}</h5>
<h3>Stock Price {{ $quote }}</h3>

<div class="p-6 bg-white border-b border-gray-200">
    <form method="post" action="/portfolio/{{ $company->symbol }}">
        @csrf
        <div class="mb-4">
            <label for="amountBuy" class="block text-grey-darker text-sm font-bold mb-2">Buy this stock: </label>
            <input class="border rounded w-full py-2 px-3 text-grey-darker" type="text"
                   name="amountBuy" id="amountBuy" placeholder="Amount">
            {{--            @error("deposit")--}}
            {{--            <p style="color: red">{{ $message }}</p>--}}
            {{--            @enderror--}}
            <input type="submit" id="submit" name="submit" value="Buy" ><br><br>
        </div>
    </form>
</div>
<div class="p-6 bg-white border-b border-gray-200">
    <form method="post" action="/portfolio/{{ $company->symbol }}">
        @csrf
        @method("PUT")
        <div class="mb-4">
            <label for="amountSell" class="block text-grey-darker text-sm font-bold mb-2">Sell this stock: </label>
            <input class="border rounded w-full py-2 px-3 text-grey-darker" type="text"
                   name="amountSell" id="amountSell" placeholder="Amount">
            {{--            @error("deposit")--}}
            {{--            <p style="color: red">{{ $message }}</p>--}}
            {{--            @enderror--}}
            <input type="submit" id="submit" name="submit" value="Sell" ><br><br>
        </div>
    </form>
</div>
