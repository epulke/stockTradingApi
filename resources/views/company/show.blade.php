
<h1>{{ $company->name }}</h1>
<img src="{{ $company->logoUrl }}" alt="{{ $company->name }} logo">
<h5>{{ $company->symbol }}</h5>
<h5>Currency: {{ $company->currency }}</h5>
<h5>Company Industry: {{ $company->industry }}</h5>
<h5>Website: {{ $company->webUrl }}</h5>
<h5>Market Capitalization {{ $company->marketCapitalization }}</h5>
<h3>Stock Price {{ $quote }}</h3>

<div class="p-6 bg-white border-b border-gray-200">
    <form method="post" action="/companies">
        @csrf
        <div class="mb-4">
            <label for="amount" class="block text-grey-darker text-sm font-bold mb-2">Buy this stock: </label>
            <input class="border rounded w-full py-2 px-3 text-grey-darker" type="text"
                   name="amount" id="amount" placeholder="Amount">
            <input type="hidden" name="symbol" id="symbol" value="{{ $company->symbol }}">
            <input type="hidden" name="quote" id="quote" value="{{ $quote }}">
            {{--            @error("deposit")--}}
            {{--            <p style="color: red">{{ $message }}</p>--}}
            {{--            @enderror--}}
            <input type="submit" id="submit" name="submit" value="Buy" ><br><br>
        </div>
    </form>
</div>
