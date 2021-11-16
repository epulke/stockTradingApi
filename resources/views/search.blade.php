<h1>Search Stocks</h1>


<div class="p-6 bg-white border-b border-gray-200">
    <form method="get" action="/companies">
        @csrf
        <div class="mb-4">
            <label for="search" class="block text-grey-darker text-sm font-bold mb-2">Search stock by name or symbol</label>
            <input class="border rounded w-full py-2 px-3 text-grey-darker" type="text"
                   name="search" id="search" placeholder="Company name or symbol">
{{--            @error("deposit")--}}
{{--            <p style="color: red">{{ $message }}</p>--}}
{{--            @enderror--}}
            <input type="submit" id="submit" name="submit" value="Search" ><br><br>
        </div>
    </form>
</div>

