@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mt-6">
                <h2 class="text-2xl font-semibold mb-4">Calendar</h2>
                <div id='calendar'></div>
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
            <h2 class="text-xl font-semibold mb-4">Add New Event</h2>
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
            <h2 class="text-xl font-semibold mb-4">Delete Event</h2>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var deleteEventId = null;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'en',
                selectable: true,
                events: '/events',
                dateClick: function(info) {
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
                },
                eventClick: function(info) {
                    deleteEventId = info.event.id;
                    document.getElementById('delete-modal').classList.remove('hidden');
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
                document.getElementById('event-title').value = '';
            });

            // Show notification with countdown
            function showNotification(message) {
                var countdownEl = document.getElementById('countdown');
                var notificationTextEl = document.getElementById('notification-text');
                var notificationModal = document.getElementById('notification-modal');

                notificationTextEl.textContent = message;
                notificationModal.classList.remove('hidden');

                var countdown = 5;
                countdownEl.textContent = countdown;
                var interval = setInterval(function() {
                    countdown--;
                    countdownEl.textContent = countdown;

                    if (countdown === 0) {
                        clearInterval(interval);
                        notificationModal.classList.add('hidden');
                    }
                }, 1000);
            }
        });
    </script>
@endsection
