@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Create TryOut</h1>

    <form id="tryoutForm" action="{{ route('tryout.store', $siswaId) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label for="mata_pelajaran" class="block text-gray-700 font-semibold">Mata Pelajaran</label>
            <input type="text" id="mata_pelajaran" name="mata_pelajaran" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="tanggal_pelaksanaan" class="block text-gray-700 font-semibold">Tanggal Pelaksanaan</label>
            <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Subtopics</label>
            <div id="subtopic-container">
                <div class="flex items-center mb-2">
                    <input type="text" name="subtopics[0][sub_mata_pelajaran]" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Sub Mata Pelajaran" required>
                    <input type="number" name="subtopics[0][skor]" class="mt-1 block w-1/4 border border-gray-300 rounded-md ml-2 p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Skor" required min="0" max="100">
                    <button type="button" onclick="removeSubtopic(this)" class="bg-red-500 text-white px-4 py-2 rounded-md ml-2 hover:bg-red-600 focus:outline-none">Delete</button>
                </div>
            </div>
            <button type="button" onclick="addSubtopic()" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none">Add Subtopic</button>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none">Submit</button>
    </form>

    <script>
        let subtopicCount = 1;

        function addSubtopic() {
            const container = document.getElementById('subtopic-container');
            const newSubtopic = document.createElement('div');
            newSubtopic.className = 'flex items-center mb-2';
            newSubtopic.innerHTML = `
                <input type="text" name="subtopics[${subtopicCount}][sub_mata_pelajaran]" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Sub Mata Pelajaran" required>
                <input type="number" name="subtopics[${subtopicCount}][skor]" class="mt-1 block w-1/4 border border-gray-300 rounded-md ml-2 p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Skor" required min="0" max="100">
                <button type="button" onclick="removeSubtopic(this)" class="bg-red-500 text-white px-4 py-2 rounded-md ml-2 hover:bg-red-600 focus:outline-none">Delete</button>
            `;
            container.appendChild(newSubtopic);
            subtopicCount++;
        }

        function removeSubtopic(button) {
            const subtopicDiv = button.parentElement; // Get the parent div of the button
            subtopicDiv.remove(); // Remove the subtopic div
        }
    </script>
</div>
@endsection
