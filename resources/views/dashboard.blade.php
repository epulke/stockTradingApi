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
                ['Task', 'Hours per Day'],
                ['Work',     11],
                ['Eat',      2],
                ['Commute',  2],
                ['Watch TV', 2],
                ['Sleep',    7]
            ]);

            var options = {
                title: 'My Portfolio',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="font-medium text-2xl">Hello, {{ $user->name }}!</p><br>

                    <p class="font-medium text-2xl">Available Funds: {{ number_format($funds, 2) }}</p>
                    <p class="font-medium text-2xl">Funds invested: {{ number_format($purchaseValue, 2) }}</p>
                    <p class="font-medium text-2xl">Portfolio value: {{ number_format($currentValue, 2) }}</p>
                    <div id="donutchart" style="width: 900px; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
