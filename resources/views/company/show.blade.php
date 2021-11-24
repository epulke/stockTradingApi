<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{  $company->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white mr-4 text-gray-700 font-bold mb-2">

                    <div class="text-center">
                        <h5 class="font-bold text-4xl">{{ $company->name }}</h5>
                        <h5 class="font-bold text-2xl">{{ $company->symbol }}</h5>

                        <div class="align-middle ">
                            <img class="object-center mx-auto" src="{{ $company->logoUrl }}" alt="{{ $company->name }} logo">
                        </div>

                        <div class="flex items-center  text-center">
                            <div class="mx-auto flex items-center p-2 ">
                                <div class="flex-1 bg-white m-4 rounded-lg p-2 xl:p-6 border-2 border-indigo-500">
                                    <h2 class="title-font text-indigo-500 font-medium sm:text-3xl text-3xl text-white">{{ $company->currency }}</h2>
                                    <p class="leading-relaxed text-gray-600 font-bold">Currency</p>
                                </div>
                                <div class="flex-1 bg-white m-4 rounded-lg p-2 xl:p-6 border-2 border-indigo-500">
                                    <h2 class="title-font text-indigo-500 font-medium sm:text-3xl text-3xl text-white">{{ $company->industry }}</h2>
                                    <p class="leading-relaxed text-gray-600 font-bold">Industry</p>
                                </div>
                                <div class="flex-1 bg-white m-4 rounded-lg p-2 xl:p-6 border-2 border-indigo-500">
                                    <h2 class="title-font text-indigo-500 font-medium sm:text-3xl text-3xl text-white"><a href="{{ $company->webUrl }}" class="hover:text-indigo-600 ">WWW</a></h2>
                                    <p class="leading-relaxed text-gray-600 font-bold">Website</p>
                                </div>
                                <div class="flex-1 bg-white m-4 rounded-lg p-2 xl:p-6 border-2 border-indigo-500">
                                    <h2 class="title-font text-indigo-500 font-medium sm:text-3xl text-3xl text-white">{{ number_format($company->marketCapitalization) }}</h2>
                                    <p class="leading-relaxed text-gray-600 font-bold">Market Cap, mUSD</p>
                                </div>
                            </div>
                        </div>

                    <div class="align-middle bg-indigo-200 mx-72 rounded-lg p-2 xl:p-6 border-2 border-indigo-500">
                            <h3 class="font-bold text-2xl ">Stock Price <br>{{ number_format($quote, 2) }}</h3>
                    </div>


                    <div class="grid gap-4 grid-cols-2 p-6 bg-white">
                        <form method="post" action="/portfolio/{{ $company->symbol }}">
                            @csrf
                            <div class="mb-4">
                                <label for="amountBuy" class="mr-4 text-gray-700 font-bold inline-block mb-2">Buy this stock: </label>
                                <input class="border bg-gray-100 py-2 px-4 w-60 outline-none focus:ring-2 focus:ring-indigo-400 rounded" type="text"
                                       name="amountBuy" id="amountBuy" placeholder="Amount">
                                <input type="submit" id="submit" name="submit" value="Buy" class="w-2/12 mt-6 text-indigo-50 font-bold bg-indigo-600 py-3 rounded-md hover:bg-indigo-500 transition duration-300">
                                @error("amountBuy")
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                                <p>Available Funds: {{ number_format($funds, 2) }}</p>
                            </div>
                        </form>


                        <form method="post" action="/portfolio/{{ $company->symbol }}">
                            @csrf
                            @method("PUT")
                            <div class="mb-4">
                                <label for="amountSell" class="mr-4 text-gray-700 font-bold inline-block mb-2">Sell this stock: </label>
                                <input class="border bg-gray-100 py-2 px-4 w-60 outline-none focus:ring-2 focus:ring-indigo-400 rounded" type="text"
                                       name="amountSell" id="amountSell" placeholder="Amount">
                                <input type="submit" id="submit" name="submit" value="Sell" class="w-2/12 mt-6 text-indigo-50 font-bold bg-indigo-600 py-3 rounded-md hover:bg-indigo-500 transition duration-300">
                                @error("amountSell")
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                                <p>Number of stocks that you have: {{ number_format($amount) }}</p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
