<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- component -->
                    <body class="flex items-center justify-center">
                    <div class="container">
                        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                            <thead class="text-white bg-indigo-600">
                            <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                                <th class="p-3 text-left">Date</th>
                                <th class="p-3 text-left">Transaction Type</th>
                                <th class="p-3 text-left">Stock Symbol</th>
                                <th class="p-3 text-left">Stock Price</th>
                            </tr>
                            </thead>
                            <tbody class="flex-1 sm:flex-none">
                            @foreach ($transactions as $transaction)
                            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $transaction->created_at }}</td>
                                <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $transaction->transaction_type }}</td>
                                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{ $transaction->stock_symbol }}</td>
                                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{ $transaction->stock_price }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
