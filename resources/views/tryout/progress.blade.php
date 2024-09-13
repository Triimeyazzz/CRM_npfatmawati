@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 transition-transform transform ">
    <h2 class="text-2xl font-semibold mb-4 text-purple-600">Statistik Tryout {{ $siswa->nama }}</h2>
    <div id="progressChart" class="mb-6" style="height: 500px;"></div>
    <div class="space-y-4">
        @foreach ($datasets as $progress)
            <div class="border-t pt-4">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">{{ $progress['label'] }} - {{ $labels[$loop->index] }}</h3>
                <p class="mb-2">Average Score: <span class="font-medium text-purple-600">{{ number_format($progress['data'][0]['y'], 2) }}</span></p>
                <h4 class="font-medium text-sm mb-1">Subtopics:</h4>
                <ul class="list-disc list-inside pl-4 space-y-1">
                    @foreach ($progress['data'][0]['subtopics'] as $index => $subtopic)
                        @if ($index < 3)
                            <li class="text-sm text-gray-700">
                                {{ $subtopic['sub_mata_pelajaran'] }}: <span class="font-medium">{{ $subtopic['skor'] }}</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @if (count($progress['data'][0]['subtopics']) > 3)
                    <a href="javascript:void(0);" class="text-purple-600 hover:underline" onclick="openSubtopicsModal('{{ json_encode($progress['data'][0]['subtopics']) }}')">View More</a>
                @endif
            </div>
        @endforeach

        <!-- Subtopics Modal -->
        <div id="subtopics-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" onclick="closeSubtopicsModal()">
            <div class="bg-white p-4 rounded shadow-lg" onclick="event.stopPropagation();">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Subtopics</h3>
                <ul id="subtopics-list" class="list-disc list-inside pl-4 space-y-1"></ul>
                <button onclick="closeSubtopicsModal()" class="mt-4 px-4 py-2 bg-gray-300 rounded">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var chartElement = document.getElementById('progressChart');
    
    if (chartElement) {
        // Create a canvas element inside the div if it's not there
        var canvas = document.createElement('canvas');
        chartElement.appendChild(canvas);
        
        var ctx = canvas.getContext('2d');
        
        var datasets = @json($datasets);
        var labels = @json($labels);

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Ensure labels are correctly set
                datasets: datasets.map(dataset => ({
                    label: dataset.label,
                    data: dataset.data.map(item => ({
                        x: item.x, // Ensure x value is correctly set
                        y: item.y
                    })),
                    borderColor: dataset.borderColor,
                    backgroundColor: dataset.backgroundColor,
                    fill: false
                }))
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'category',
                        labels: labels
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Average Score'
                        }
                    }
                }
            }
        });
    } else {
        console.error('Chart element not found');
    }
});

function openSubtopicsModal(subtopics) {
    const subtopicsData = JSON.parse(subtopics);
    const subtopicsList = document.getElementById('subtopics-list');
    subtopicsList.innerHTML = '';

    subtopicsData.forEach(function(subtopic) {
        const li = document.createElement('li');
        li.classList.add('text-sm', 'text-gray-700');
        li.textContent = `${subtopic.sub_mata_pelajaran}: ${subtopic.skor}`;
        subtopicsList.appendChild(li);
    });

    document.getElementById('subtopics-modal').classList.remove('hidden');
}

function closeSubtopicsModal() {
    document.getElementById('subtopics-modal').classList.add('hidden');
}

</script>
@endsection
