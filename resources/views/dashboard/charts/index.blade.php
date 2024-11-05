@extends('dashboard.layout.side')

@section('content')
<div class="flex flex-col items-center bg-gray-100 p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl">
        @php
            $chartData = [
                ['title' => 'Users', 'count' => $userCount, 'color' => '#3498db', 'icon' => 'fas fa-users'],
                ['title' => 'Drugs', 'count' => $drugCount, 'color' => '#2ecc71', 'icon' => 'fas fa-pills'],
                ['title' => 'Warehouses', 'count' => $warehouseCount, 'color' => '#f39c12', 'icon' => 'fas fa-warehouse'],
                ['title' => 'Categories', 'count' => $drugCategoryCount, 'color' => '#e74c3c', 'icon' => 'fas fa-list']
            ];
        @endphp

        @foreach($chartData as $data)
        <div class="bg-white p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-3xl font-semibold text-gray-800">{{ $data['title'] }}</h3>
                <i class="{{ $data['icon'] }} text-4xl" style="color: {{ $data['color'] }}"></i>
            </div>
            <div class="aspect-w-1 aspect-h-1">
                <canvas id="{{ strtolower($data['title']) }}Chart"></canvas>
            </div>
            <p class="mt-6 text-center text-4xl font-bold" style="color: {{ $data['color'] }}">{{ $data['count'] }}</p>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
<script>
    const createChart = (ctx, label, data, color) => {
        return new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [label, ''],
                datasets: [{
                    data: [data, 100],
                    backgroundColor: [color, 'rgba(230, 230, 230, 0.8)'],
                    borderColor: [color, 'rgba(230, 230, 230, 0.8)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                animation: {
                    animateRotate: true,
                    animateScale: true
                },
                hover: {
                    mode: 'nearest',
                    intersect: true,
                    onHover: (event, elements) => {
                        event.native.target.style.cursor = elements[0] ? 'pointer' : 'default';
                    }
                }
            }
        });
    };

    @foreach($chartData as $data)
        createChart(
            document.getElementById('{{ strtolower($data['title']) }}Chart').getContext('2d'),
            '{{ $data['title'] }}',
            {{ $data['count'] }},
            '{{ $data['color'] }}'
        );
    @endforeach
</script>
@endsection
