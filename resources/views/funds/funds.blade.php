<h1>My Funds</h1>

@if ( $funds === 0)
    <h4>You have no funds</h4>
@else
    <h4>You have invested USD {{ $funds }}.</h4>
@endif

<div class="p-6 bg-white border-b border-gray-200">
    <form method="post" >
        @csrf
        <div class="mb-4">
            <label for="deposit" class="block text-grey-darker text-sm font-bold mb-2">Deposit Funds</label>
            <input class="border rounded w-full py-2 px-3 text-grey-darker" type="text"
                   name="deposit" id="deposit" placeholder="Enter amount in USD">
            @error("deposit")
                <p style="color: red">{{ $message }}</p>
            @enderror
            <input type="submit" id="submit" name="submit" value="Deposit" ><br><br>
        </div>
    </form>
</div>
<div class="p-6 bg-white border-b border-gray-200">
    <a href="/user/funds/withdraw">Withdraw Funds</a>
</div>
