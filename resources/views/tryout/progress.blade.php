@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $siswa->nama }}'s Progress</h1>

    <!-- Button to toggle chart type -->
    <div class="mb-4">
        <button id="toggleChart" class="bg-blue-500 text-white px-4 py-2 rounded">Switch to Line Chart</button>
    </div>

    <div>
        <canvas id="progressChart"></canvas>
    </div>

    <!-- Modal for displaying subtopics -->
    <div id="subtopicModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-4 rounded">
            <h2 class="text-lg font-bold">Subtopics</h2>
            <ul id="subtopicList"></ul>
            <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const labels = @json($labels);
            const datasets = @json($datasets);

            // Check the data received
            console.log('Labels:', labels);
            console.log('Datasets:', datasets);

            let chartType = 'bar'; // Default to bar chart

            const createChart = () => {
                const data = {
                    labels: labels,
                    datasets: datasets.map(dataset => ({
                        label: dataset.label,
                        data: dataset.data.map(point => ({
                            y: point.y,
                            subtopics: point.subtopics || [] // Ensure subtopics are included
                        })),
                        borderColor: dataset.borderColor,
                        backgroundColor: chartType === 'bar' ? dataset.backgroundColor : 'transparent', // Use transparent for line chart
                        borderWidth: chartType === 'line' ? 2 : 0, // Set border width for line chart
                        barThickness: chartType === 'bar' ? 20 : undefined, // Set bar thickness for bar chart
                    })),
                };

                // Check the data being used for the chart
                console.log('Chart Data:', data);

                const config = {
                    type: chartType,
                    data: data,
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tanggal Pelaksanaan',
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Average Score',
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        const score = tooltipItem.raw.y; // Access the y value
                                        const subtopics = datasets[tooltipItem.datasetIndex].data[tooltipItem.dataIndex].subtopics || [];
                                        return ['Score: ' + score, ...subtopics.map(sub => 'Subtopic: ' + sub)];
                                    }
                                }
                            }
                        },
                        onClick: (event) => {
                            const activePoints = progressChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false);
                            if (activePoints.length) {
                                const datasetIndex = activePoints[0].datasetIndex;
                                const dataIndex = activePoints[0].index;
                                const subtopics = datasets[datasetIndex].data[dataIndex].subtopics; // Access subtopics
                                showSubtopics(subtopics);
                            }
                        }
                    },
                };

                return new Chart(document.getElementById('progressChart'), config);
            };

            let progressChart = createChart(); // Create the initial chart

            // Function to show subtopics
            function showSubtopics(subtopics) {
                const subtopicList = document.getElementById('subtopicList');
                subtopicList.innerHTML = ''; // Clear existing subtopics
                subtopics.forEach(subtopic => {
                    const li = document.createElement('li');
                    li.textContent = subtopic; // Assuming subtopic is a string
                    subtopicList.appendChild(li);
                });
                document.getElementById('subtopicModal').classList.remove('hidden');
            }

            // Close modal functionality
            document.getElementById('closeModal').addEventListener('click', function () {
                document.getElementById('subtopicModal').classList.add('hidden');
            });

            // Toggle chart type
            document.getElementById('toggleChart').addEventListener('click', function () {
                chartType = chartType === 'bar' ? 'line' : 'bar'; // Toggle between 'bar' and 'line'
                progressChart.destroy(); // Destroy the current chart instance
                progressChart = createChart(); // Create a new chart instance
                this.textContent = chartType === 'bar' ? 'Switch to Line Chart' : 'Switch to Bar Chart'; // Update button text
            });
        });
        console.log('Labels:', @json($labels));
console.log('Datasets:', @json($datasets));
    </script>
</div>
@endsection
