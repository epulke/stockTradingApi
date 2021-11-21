<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portfolio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- component -->
                    <body class="flex items-center justify-center">
                    <form method="get" action="/portfolio/filter">
                        @csrf
                        <div class="mb-4">
                            <label for="position" class="mr-4 text-gray-700 font-bold inline-block mb-2">Sort by: </label>
                            <select name="position" id="position" class="border bg-gray-100 py-2 px-4 w-60 outline-none focus:ring-2 focus:ring-indigo-400 rounded">
                                <option value="stockSymbol">Stock Symbol</option>
                                <option value="amount">Amount</option>
                                <option value="purchaseValue">Purchase Value</option>
                                <option value="currentValue">Current Value</option>
                                <option value="profitloss">Profit/Loss</option>
                                <option value="quote">Quote</option>
                            </select>
                            <select name="type" id="type" class="border bg-gray-100 py-2 px-4 w-60 outline-none focus:ring-2 focus:ring-indigo-400 rounded">
                                <option value="ascending">Ascending</option>
                                <option value="descending">Descending</option>
                            </select>
                            <input type="submit" id="submit" name="submit" value="Sort" class="w-2/12 mt-6 text-indigo-50 font-bold bg-indigo-600 py-3 rounded-md hover:bg-indigo-500 transition duration-300">
                            @error("position")
                            <p style="color: red">{{ $message }}</p>
                            @enderror
                            @error("type")
                            <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </form>

                    <div class="container">
                        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                            <thead class="text-white bg-indigo-600 ">
                            <tr class="bg-teal-400 flex flex-col flex-no wrap  sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                                <th class="p-3 text-right">Stock</th>
                                <th class="p-3 text-right">Amount</th>
                                <th class="p-3 text-right">Purchase Value</th>
                                <th class="p-3 text-right">Current Value</th>
                                <th class="p-3 text-right">Profit/Loss</th>
                                <th class="p-3 text-right" width="110px">Quote</th>
                            </tr>

                            @foreach ($portfolio as $entry)
                            </thead>
                            <tbody class="flex-1 sm:flex-none">
                            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 text-right">
                                <td class="border-grey-light border hover:bg-gray-100 p-3">
                                    <a href="/companies/{{ $entry->getUserStock()->stock_symbol }}">{{ $entry->getUserStock()->stock_symbol }}</a>
                                </td>
                                <td class="border-grey-light border p-3 truncate">{{ number_format($entry->getUserStock()->amount) }}</td>
                                <td class="border-grey-light border p-3 truncate">{{ number_format($entry->getUserStock()->purchase_value, 2) }}</td>
                                <td class="border-grey-light border p-3 truncate">{{ number_format($entry->getCurrentValue(), 2) }}</td>
                                <td class="border-grey-light border p-3 truncate">{{ number_format($entry->getProfitLoss(), 2) }}</td>
                                <td class="border-grey-light border p-3 truncate">{{ number_format($entry->getQuote()->quote, 2) }}</td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {{ $portfolio->links() }}
                    </div>
                    </body>

                    <style>
                        html,
                        body {
                            height: 100%;
                        }

                        @media (min-width: 640px) {
                            table {
                                display: inline-table !important;
                            }

                            thead tr:not(:first-child) {
                                display: none;
                            }
                        }

                        td:not(:last-child) {
                            border-bottom: 0;
                        }

                        th:not(:last-child) {
                            border-bottom: 2px solid rgba(0, 0, 0, .1);
                        }
                    </style>


                </div>
            </div>
        </div>
    </div>



</x-app-layout>
