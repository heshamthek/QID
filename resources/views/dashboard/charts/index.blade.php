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
    const createChart = (ctx, label, data) => {
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [label],
                datasets: [{
                    label: label,
                    data: [data],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                    ],
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

    createChart(document.getElementById('usersChart').getContext('2d'), 'Users', {{ $userCount }});
    createChart(document.getElementById('drugsChart').getContext('2d'), 'Drugs', {{ $drugCount }});
    createChart(document.getElementById('warehousesChart').getContext('2d'), 'Warehouses', {{ $warehouseCount }});
    createChart(document.getElementById('categoriesChart').getContext('2d'), 'Categories', {{ $drugCategoryCount }});
</script>
@endsection
