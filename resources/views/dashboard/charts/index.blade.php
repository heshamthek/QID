@extends('dashboard.layout.side')  <!-- Adjust according to your layout -->

@section('content')
<div class="flex flex-col items-center">
    <h2 class="text-2xl font-semibold mb-4">Pharmacy Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-xl font-semibold">Users</h3>
            <canvas id="usersChart"></canvas>
            <p class="mt-2 text-center text-lg">{{ $userCount }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-xl font-semibold">Drugs</h3>
            <canvas id="drugsChart"></canvas>
            <p class="mt-2 text-center text-lg">{{ $drugCount }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-xl font-semibold">Warehouses</h3>
            <canvas id="warehousesChart"></canvas>
            <p class="mt-2 text-center text-lg">{{ $warehouseCount }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-xl font-semibold">Categories</h3>
            <canvas id="categoriesChart"></canvas>
            <p class="mt-2 text-center text-lg">{{ $drugCategoryCount }}</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const createChart = (ctx, label, data, backgroundColor, borderColor) => {
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [label],
                datasets: [{
                    label: label,
                    data: [data],
                    backgroundColor: [backgroundColor],
                    borderColor: [borderColor],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    };

    createChart(document.getElementById('usersChart').getContext('2d'), 'Users', {{ $userCount }}, 'rgba(0, 123, 255, 0.6)', 'rgba(0, 123, 255, 1)'); // Blue
    createChart(document.getElementById('drugsChart').getContext('2d'), 'Drugs', {{ $drugCount }}, 'rgba(40, 167, 69, 0.6)', 'rgba(40, 167, 69, 1)'); // Green
    createChart(document.getElementById('warehousesChart').getContext('2d'), 'Warehouses', {{ $warehouseCount }}, 'rgba(255, 193, 7, 0.6)', 'rgba(255, 193, 7, 1)'); // Yellow
    createChart(document.getElementById('categoriesChart').getContext('2d'), 'Categories', {{ $drugCategoryCount }}, 'rgba(220, 53, 69, 0.6)', 'rgba(220, 53, 69, 1)'); // Red
</script>
@endsection
