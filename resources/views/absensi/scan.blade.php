@extends('layouts.app')

@section('content')
<div class="container mx-auto my-8">
    <h1 class="text-2xl font-bold mb-4">Scan QR Code</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('absensi.scanQr') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="id" class="block text-gray-700">Enter Student ID:</label>
            <input type="text" name="id" id="id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Scan or Enter Student ID" required>
        </div>

        <!-- Increase size of the camera feed -->
        <div id="reader" style="width: 500px; height: 500px;"></div> <!-- Increased dimensions -->

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
    </form>

    <!-- Success message for scan -->
    <div id="scan-message" class="mt-4 text-green-500"></div>

    <!-- Audio element for scan success sound -->
    <audio id="scan-sound" src="{{ asset('/audio/onisan.mp3') }}" preload="auto"></audio>
</div>

<!-- Load the Html5Qrcode library -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>


<script>

    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        document.getElementById('id').value = decodedText;

        // Play the scan success sound
        document.getElementById('scan-sound').play();

        // Show success message
        document.getElementById('scan-message').innerText = "QR Code scanned successfully!";
    }

    function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning.
    // for example:
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader",{
        fps: 20,
        qrbox: {
                    width: 250,
                    height: 250
                }
    },/* verbose= */ false);

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>

@endsection
