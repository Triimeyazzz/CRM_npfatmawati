@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        .digital-clock {
            font-size: 1.5em;
            color: #8b16ce;
            margin-top: 10px;
        }
        @media (min-width: 640px) {
            .digital-clock {
                font-size: 2em;
                margin-top: 20px;
            }
        }
        
    .fc-event.birthday-event {
        background-color: #ffcc00; /* Bright yellow for birthday events */
        border: 2px solid #ff6600; /* Orange border */
        color: #ffffff; /* White text */
        font-weight: bold; /* Bold text */
        text-align: center; /* Center text */
        font-size: 1em; /* Adjust font size */
        display: block; /* Ensure block display */
        padding: 2px 5px; /* Add padding */
        max-width: 80%; /* Ensure the event does not take full width */
        margin: 0 auto; /* Center the event within the date box */
        border-radius: 5px; /* Round the corners for a more modern look */
    }

    /* Optional: Smaller event size */
    .fc-daygrid-day-events .fc-event {
        white-space: nowrap; /* Prevent text from breaking into new lines */
        overflow: hidden; /* Hide overflowed content */
        text-overflow: ellipsis; /* Add ellipsis for overflowed text */
    }

    /* Add a festive icon for birthday events */
    .fc-event.birthday-event::before {
        content: "🎂"; /* Cake emoji */
        font-size: 1.2em;
        margin-right: 5px;
    }

    /* Optional: Adding a shadow to make it pop */
    .fc-event.birthday-event {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15); /* Softer shadow */
    }

    /* If you want the hover effect */
    .fc-event.birthday-event:hover {
        background-color: #ffb900; /* Change to a slightly darker yellow */
        transform: scale(1.05); /* Slight zoom on hover */
        transition: all 0.2s ease; /* Smooth transition */
    }
    @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.fc-event.birthday-event {
    animation: pulse 1s infinite; /* Add pulse animation */
}

    </style>
    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">
                    Selamat Datang {{ Auth::user()->name }}
                </div>
                <div class="digital-clock p-4" id="digital-clock"></div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg col-span-1 sm:col-span-2 lg:col-span-2">
                        <div class="p-4 sm:p-6">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Ringkasan</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                <div class="bg-purple-100 dark:bg-purple-900 p-4 rounded-lg">
                                    <h4 class="text-sm font-medium text-purple-600 dark:text-purple-300">
                                        <i class="fas fa-user-shield inline-block"></i>
                                        Total Admins
                                    </h4>
                                    <p class="text-xl sm:text-2xl font-bold text-purple-800 dark:text-purple-100">{{ $totalAdmins }}</p>
                                </div>
                                <div class="bg-indigo-100 dark:bg-indigo-900 p-4 rounded-lg">
                                    <h4 class="text-sm font-medium text-indigo-600 dark:text-indigo-300">
                                        <i class="fa-solid fa-user"></i>
                                        Total Siswa
                                    </h4>
                                    <p class="text-xl sm:text-2xl font-bold text-indigo-800 dark:text-indigo-100">{{ $totalSiswa }}</p>
                                </div>
                                <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg">
    <h4 class="text-sm font-medium text-blue-600 dark:text-blue-300">
        <i class="fa-solid fa-money-bill"></i>
        Total Pemasukan
    </h4>
    <p class="text-xl sm:text-2xl font-bold text-blue-800 dark:text-blue-100">{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
</div>
<div class="bg-green-100 dark:bg-green-900 p-4 rounded-lg">
    <h4 class="text-sm font-medium text-green-600 dark:text-green-300">
        <i class="fa-solid fa-money-bill"></i>
        Total Tagihan
    </h4>
    <p class="text-xl sm:text-2xl font-bold text-green-800 dark:text-green-100">{{ number_format($totalTagihan, 0, ',', '.') }}</p>
</div>
<div class="bg-red-100 dark:bg-red-900 p-4 rounded-lg">
    <h4 class="text-sm font-medium text-red-600 dark:text-red-300">
        <i class="fa-solid fa-money-bill"></i>
        Sisa Tagihan
    </h4>
    <p class="text-xl sm:text-2xl font-bold text-red-800 dark:text-red-100">{{ number_format($sisaTagihan, 0, ',', '.') }}</p>
</div>

                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                        <div class="p-4 sm:p-6">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Quick Actions</h3>
                            <div class="space-y-2">
                                <a href="/admin/siswa/create" class="block w-full text-center px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition duration-150 ease-in-out">Tambahkan Siswa</a>
                                <a href="/pembayaran/create" class="block w-full text-center px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition duration-150 ease-in-out">Tambah Tagihan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6">
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">List Siswa</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @foreach($siswas->take(4) as $item)
                                <div class="flex flex-col items-center hover:scale-105 duration-300">
                                    <img
                                    src="{{ asset('/storage/photos/' . $item->foto) }}"
                                        alt="{{ $item->nama }}'s photo"
                                        class="w-16 h-16 rounded-full object-cover mb-2"
                                    />
                                    <p class="text-sm font-semibold text-center text-gray-800 dark:text-gray-200">{{ $item->nama }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item->email }}</p>
                                </div>
                            @endforeach
                        </div>
                        <a href="/admin/siswa" class="mt-4 block text-center text-purple-500 hover:text-purple-700 dark:text-purple-400 dark:hover:text-purple-300">Lihat semua Siswa</a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg sm:text-xl font-bold text-purple-600 mb-4">Statistika Pemasukan</h2>
                        
                        <div class="flex justify-between mb-4">
                            <button id="lineChart" class="bg-purple-600 text-white px-3 py-1 sm:px-4 sm:py-2 rounded text-sm sm:text-base">Line Chart</button>
                            <button id="barChart" class="bg-purple-600 text-white px-3 py-1 sm:px-4 sm:py-2 rounded text-sm sm:text-base">Bar Chart</button>
                        </div>

                        <canvas id="pemasukanChart" class="w-full"></canvas>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Kalender</h3>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- FullCalendar CSS --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    
    {{-- FullCalendar JS --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js'></script>

    {{-- Event Add Modal --}}
    <div id="event-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-10">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full p-6">
            <h2 class="text-xl font-semibold mb-4 text-purple-600">Add New Event</h2>
            <input type="text" id="event-title" placeholder="Enter event title" class="w-full p-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
            <div class="flex justify-end">
                <button id="close-modal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg mr-2">Cancel</button>
                <button id="save-event" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">Save</button>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-10">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full p-6">
            <h2 class="text-xl font-semibold mb-4 text-purple-600">Delete Event</h2>
            <p class="mb-4">Are you sure you want to delete this event?</p>
            <div class="flex justify-end">
                <button id="cancel-delete" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg mr-2">Cancel</button>
                <button id="confirm-delete" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Delete</button>
            </div>
        </div>
    </div>

    {{-- Success Notification Modal --}}
    <div id="notification-modal" class="fixed bottom-4 right-4 bg-green-500 text-white rounded-lg shadow-lg p-4 flex items-center space-x-4 hidden z-10">
        <span id="notification-text">Event deleted successfully!</span>
        <span id="countdown" class="bg-white text-green-500 font-semibold px-2 py-1 rounded-full">5</span>
    </div>

        {{-- Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var deleteEventId = null;
    var todayBirthdays = []; // To store today's birthdays

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'en',
        selectable: true,
        events: function(fetchInfo, successCallback, failureCallback) {
            // Fetch regular events
            fetch('/events')
                .then(response => response.json())
                .then(eventsData => {
                    // Fetch student birthdays
                    fetch('/birthdays')
                        .then(response => response.json())
                        .then(birthdayData => {
                            // Check for today's birthdays
                            todayBirthdays = birthdayData.filter(event => event.isToday);
                            displayBirthdayGreeting(todayBirthdays); // Display greeting if any birthdays today
                            
                            // Merge both regular events and birthdays
                            successCallback(eventsData.concat(birthdayData));
                        });
                });
        },
        eventClick: function(info) {
            deleteEventId = info.event.id;
            document.getElementById('delete-modal').classList.remove('hidden');
        },
        dateClick: function(info) {
            // Show add event modal
            document.getElementById('event-modal').classList.remove('hidden');
            document.getElementById('save-event').onclick = function() {
                var eventTitle = document.getElementById('event-title').value;
                if (eventTitle) {
                    fetch('/events', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            title: eventTitle,
                            start: info.dateStr
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        calendar.addEvent({
                            id: data.id,
                            title: data.title,
                            start: data.start,
                            allDay: true
                        });
                        document.getElementById('event-modal').classList.add('hidden');
                        document.getElementById('event-title').value = '';
                    });
                }
            };
        }
    });

    calendar.render();

    // Handle Delete Confirmation
    document.getElementById('confirm-delete').addEventListener('click', function() {
        fetch('/events/' + deleteEventId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                calendar.getEventById(deleteEventId).remove();
                showNotification('Event deleted successfully!');
            }
            document.getElementById('delete-modal').classList.add('hidden');
        });
    });

    // Cancel Delete
    document.getElementById('cancel-delete').addEventListener('click', function() {
        document.getElementById('delete-modal').classList.add('hidden');
    });

    // Close Add Event Modal
    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('event-modal').classList.add('hidden');
    });

    // Display a greeting for today's birthdays
    function displayBirthdayGreeting(todayBirthdays) {
        if (todayBirthdays.length > 0) {
            var greetingText = '🎉 Happy Birthday to ';
            todayBirthdays.forEach(function(event, index) {
                greetingText += event.title.replace('🎉 ', '');
                if (index < todayBirthdays.length - 1) {
                    greetingText += ' & ';
                }
            });
            document.getElementById('birthday-greeting').innerText = greetingText + '!';
            document.getElementById('birthday-greeting').classList.remove('hidden');
        }
    }
});

        // Show Notification
        function showNotification(message) {
            var notification = document.getElementById('notification-modal');
            var countdown = document.getElementById('countdown');
            notification.classList.remove('hidden');
            notification.querySelector('#notification-text').textContent = message;

            var seconds = 5;
            countdown.textContent = seconds;
            var interval = setInterval(function() {
                seconds--;
                countdown.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(interval);
                    notification.classList.add('hidden');
                }
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('pemasukanChart').getContext('2d');
            const bulan = @json($pemasukanPerBulan->pluck('month')); // Array of month labels
            const total = @json($pemasukanPerBulan->pluck('total')); // Array of totals

            let chartType = 'line'; // Default chart type
            let pemasukanChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: bulan,
                    datasets: [{
                        label: 'Total Pemasukan',
                        data: total,
                        borderColor: 'rgba(156, 39, 176, 1)',
                        backgroundColor: 'rgba(156, 39, 176, 0.2)',
                        borderWidth: 2,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });

            document.getElementById('lineChart').addEventListener('click', function() {
                if (chartType !== 'line') {
                    chartType = 'line';
                    updateChart();
                }
            });

            document.getElementById('barChart').addEventListener('click', function() {
                if (chartType !== 'bar') {
                    chartType = 'bar';
                    updateChart();
                }
            });

            function updateChart() {
                pemasukanChart.destroy(); // Destroy the previous chart instance
                pemasukanChart = new Chart(ctx, {
                    type: chartType,
                    data: {
                        labels: bulan,
                        datasets: [{
                            label: 'Total Pemasukan',
                            data: total,
                            borderColor: 'rgba(156, 39, 176, 1)',
                            backgroundColor: chartType === 'bar' ? 'rgba(156, 39, 176, 0.2)' : 'rgba(156, 39, 176, 0.2)',
                            borderWidth: 2,
                            fill: chartType === 'line',
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                            }
                        }
                    }
                });
            }
        });
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('digital-clock').textContent = `${hours}:${minutes}:${seconds}`;
        }
        
        setInterval(updateClock, 1000);
        updateClock(); // Initial call to display clock immediately
    </script>
@endsection
