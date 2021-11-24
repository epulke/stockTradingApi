<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                [ "Stock" , "Percentage"],
                @foreach ($stocksProportion as $stock)
                    [ " {{ $stock[0] }} ", {{ $stock[1] }} ],
                @endforeach
                ]);

            var options = {
                title: 'Portfolio by Current Value',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mr-4 text-gray-700 font-bold mb-2" >
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="container px-5 py-6 mx-auto">
                        <div class="flex flex-wrap w-full mb-8" style="display: flex">
                            <div class="w-full mb-6 lg:mb-0">
                                <h1 class="sm:text-4xl text-center text-5xl font-medium title-font mb-2 text-gray-900">Hello, <b>{{ $user->name }}</b>!</h1>

                            </div>
                        </div>
                        <div class="flex items-center  text-center">
                            <div class="mx-auto flex items-center p-2 ">
                                <div class="flex-1 bg-indigo-500 m-4 rounded-lg p-2 xl:p-6">
                                    <h2 class="title-font font-medium sm:text-3xl text-3xl text-white">{{ number_format($funds, 2) }}</h2>
                                    <p class="leading-relaxed text-gray-100 font-bold">Available Funds</p>
                                </div>
                                <div class="flex-1 bg-indigo-500 m-4 rounded-lg p-2 xl:p-6">
                                    <h2 class="title-font font-medium sm:text-3xl text-3xl text-white">{{ number_format($purchaseValue, 2) }}</h2>
                                    <p class="leading-relaxed text-gray-100 font-bold">Funds Invested</p>
                                </div>
                                <div class="flex-1 bg-indigo-500 m-4 rounded-lg p-2 xl:p-6">
                                    <h2 class="title-font font-medium sm:text-3xl text-3xl text-white">{{ number_format($currentValue, 2) }}</h2>
                                    <p class="leading-relaxed text-gray-100 font-bold">Portfolio Value</p>
                                </div>
                                <div class="flex-1 bg-indigo-500 m-4 rounded-lg p-2 xl:p-6">
                                    <h2 class="title-font font-medium sm:text-3xl text-3xl text-white">{{ number_format($profitLoss, 2) }}</h2>
                                    <p class="leading-relaxed text-gray-100 font-bold">Profit/Loss</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="block" id="donutchart" style="width: 900px; height: 500px; margin: 0 auto;"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
