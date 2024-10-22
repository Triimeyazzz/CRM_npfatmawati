@extends('layouts.app')
@section('content')
<div class="container mx-auto my-8">
    <h1 class="text-2xl font-bold mb-4">Scan QR Code</h1>
    <!-- Display Success Message -->
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4 transition-opacity duration-1000 ease-in-out">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white p-6 rounded shadow">
        <div class="mb-4">
            <label for="id" class="block text-gray-700">Student ID:</label>
            <input type="text" name="id" id="id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Scan Student ID" readonly>
        </div>
        <!-- Increase size of the camera feed -->
        <div id="reader" style="width: 500px; height: 500px;"></div> <!-- Increased dimensions -->
    </div>
    <!-- Success message for scan -->
    <div id="scan-message" class="mt-4 text-green-500"></div>
    <!-- Audio element for scan success sound -->
    <audio id="scan-sound" src="{{ asset('/audio/Scan Berhasil, silahkan submit.mp3') }}" preload="auto"></audio>
</div>

<!-- Modal -->
<div id="submitModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm Submission</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Are you sure you want to submit this attendance?
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <form action="{{ route('absensi.scanQr') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="modal-id">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Submit
                    </button>
                </form>
                <button id="cancelButton" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Load the Html5Qrcode library -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Automatically hide success message after 5 seconds with countdown
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.classList.add('opacity-0');
                setTimeout(() => successMessage.remove(), 1000); // Wait for animation to complete before removing
            }, 5000); // 5-second delay before starting the fade-out
        }
        const readerElement = document.getElementById("reader");
        const scanMessageElement = document.getElementById("scan-message");
        const scanSound = document.getElementById("scan-sound");
        const submitModal = document.getElementById("submitModal");
        const cancelButton = document.getElementById("cancelButton");

        if (readerElement) {
            // Initialize the Html5Qrcode instance
            const html5QrCode = new Html5Qrcode("reader");
            // Start scanning
            html5QrCode.start(
                { facingMode: "environment" },
                {
                    fps: 20, // Increased FPS for smoother scanning
                    qrbox: { width: 300, height: 300 } // Adjusted size for better accuracy
                },
                onScanSuccess,
                onScanError
            ).catch(err => {
                console.error("Failed to start the scanner:", err);
            });
        } else {
            console.error("QR Code reader element not found.");
        }

        cancelButton.addEventListener("click", function() {
            submitModal.classList.add("hidden");
        });
    });

    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        document.getElementById('id').value = decodedText;
        document.getElementById('modal-id').value = decodedText;
        // Play the scan success sound
        document.getElementById('scan-sound').play();
        // Show success message
        document.getElementById('scan-message').innerText = "QR Code scanned successfully!";
        // Show the modal
        document.getElementById('submitModal').classList.remove("hidden");
    }

    function onScanError(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
    }
</script>
@endsection