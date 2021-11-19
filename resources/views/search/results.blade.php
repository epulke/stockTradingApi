<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="p-6 bg-white ">
                        <form method="get" action="/companies">
                            @csrf
                            <div class="mb-6">
                                <label for="search" class="mr-4 text-gray-700 font-bold inline-block mb-2">Search stock by name or symbol</label>
                                <input class="border bg-gray-100 py-2 px-4 w-96 outline-none focus:ring-2 focus:ring-indigo-400 rounded" type="text"
                                       name="search" id="search" placeholder="Company name or symbol">
                                @error("search")
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                                <input type="submit" id="submit" name="submit" value="Search" class="w-1/12 mt-6 text-indigo-50 font-bold bg-indigo-600 py-3 rounded-md hover:bg-indigo-500 transition duration-300"><br><br>
                            </div>
                        </form>
                    </div>

                    @if (isset($stocks))
                        <body class="flex items-center justify-center">
                        <div class="container">
                            <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                                <thead class="text-white bg-indigo-600">
                                <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                                    <th class="p-3 text-left">Company Name</th>
                                    <th class="p-3 text-left">Company Symbol</th>
                                </tr>
                                </thead>

                                <tbody class="flex-1 sm:flex-none">
                                @foreach ($stocks as $stock)
                                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                    <td class="border-grey-light border hover:bg-gray-100 p-3"><a href="/companies/{{ $stock->symbol }}">{{ $stock->name }}</a></td>
                                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{ $stock->symbol }}</td>
                                </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        </body>
                    @endif

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
