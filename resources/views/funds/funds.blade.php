<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Funds') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="text-center">
                        @if ( $funds === 0)
                            <h4 class="font-medium text-3xl">You have no funds</h4>
                        @else
                            <h4 class="font-medium text-3xl">You have invested</h4><br>

                            <h1 class="font-bold text-4xl">USD {{ number_format($funds, 2) }}</h1>
                        @endif
                    </div>


                    <div class="p-6 bg-white text-center">
                        <form method="post" >
                            @csrf
                            <div class="mb-6">
                                <label for="deposit" class="mr-4 text-gray-700 font-bold inline-block mb-2">Deposit Funds       </label>
                                <input class="border bg-gray-100 py-2 px-4 w-96 outline-none focus:ring-2 focus:ring-indigo-400 rounded" type="text"
                                       name="deposit" id="deposit" placeholder="Enter amount in USD">
                                <input type="submit" id="submit" name="submit" value="Deposit" class="w-1/12 mt-6 text-indigo-50 font-bold bg-indigo-600 py-3 rounded-md hover:bg-indigo-500 transition duration-300" >
                                @error("deposit")
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>

                        <form method="post" action="/user/funds/withdraw">
                            @csrf
                            <div class="mb-6">
                                <label for="withdraw" class="mr-4 text-gray-700 font-bold inline-block mb-2">Withdraw Funds</label>
                                <input class="border bg-gray-100 py-2 px-4 w-96 outline-none focus:ring-2 focus:ring-indigo-400 rounded" type="text"
                                       name="withdraw" id="withdraw" placeholder="Enter amount in USD">
                                <input type="submit" id="submit" name="submit" value="Withdraw" class="w-1/12 mt-6 text-indigo-50 font-bold bg-indigo-600 py-3 rounded-md hover:bg-indigo-500 transition duration-300" >
                                @error("withdraw")
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
