@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create TryOut</h1>

    <form id="tryoutForm" action="{{ route('tryout.store', $siswaId) }}" method="POST"> <!-- Updated action here -->
        @csrf

        <div class="mb-4">
            <label for="mata_pelajaran" class="block text-gray-700">Mata Pelajaran</label>
            <input type="text" id="mata_pelajaran" name="mata_pelajaran" class="mt-1 block w-full border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="tanggal_pelaksanaan" class="block text-gray-700">Tanggal Pelaksanaan</label>
            <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" class="mt-1 block w-full border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Subtopics</label>
            <div id="subtopic-container">
                <div class="flex items-center mb-2">
                    <input type="text" name="subtopics[0][sub_mata_pelajaran]" class="mt-1 block w-full border border-gray-300 rounded-md" placeholder="Sub Mata Pelajaran" required>
                    <input type="number" name="subtopics[0][skor]" class="mt-1 block w-1/4 border border-gray-300 rounded-md ml-2" placeholder="Skor" required min="0" max="100">
                </div>
            </div>
            <button type="button" onclick="addSubtopic()" class="btn btn-secondary">Add Subtopic</button>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        let subtopicCount = 1;

        function addSubtopic() {
            const container = document.getElementById('subtopic-container');
            const newSubtopic = document.createElement('div');
            newSubtopic.className = 'flex items-center mb-2';
            newSubtopic.innerHTML = `
                <input type="text" name="subtopics[${subtopicCount}][sub_mata_pelajaran]" class="mt-1 block w-full border border-gray-300 rounded-md" placeholder="Sub Mata Pelajaran" required>
                <input type="number" name="subtopics[${subtopicCount}][skor]" class="mt-1 block w-1/4 border border-gray-300 rounded-md ml-2" placeholder="Skor" required min="0" max="100">
            `;
            container.appendChild(newSubtopic);
            subtopicCount++;
        }

        function updateFormAction(siswaId) {
            const form = document.getElementById('tryoutForm');
            if (siswaId) {
                form.action = `{{ url('tryout') }}/${siswaId}`; // Update this if you dynamically set siswaId
            }
        }
    </script>

</div>
@endsection
