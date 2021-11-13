<h1>My Funds</h1>

@if (Auth::user()->wallet === null)
    <h4>You have no funds</h4>
@else
    <h4>You have invested {{ Auth::user()->wallet }}</h4>
@endif

<div class="p-6 bg-white border-b border-gray-200">
    <form method="post" action="/user/funds/withdraw">
        @csrf
        <div class="mb-4">
            <label for="withdraw" class="block text-grey-darker text-sm font-bold mb-2">Withdraw Funds</label>
            <input class="border rounded w-full py-2 px-3 text-grey-darker" type="text"
                   name="withdraw" id="withdraw" placeholder="Enter amount in USD">
            <input type="submit" id="submit" name="submit"
                   onclick="return confirm('Are you sure you want to withdraw this amount?')"
                   value="Withdraw" ><br><br>
        </div>
    </form>
</div>

