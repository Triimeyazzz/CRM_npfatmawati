@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Messages</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($siswa as $siswaItem)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex items-center p-4">
                <!-- Student photo -->
                <img 
                    src="{{ asset('storage/fotos/' . $siswaItem->foto) ?? 'https://via.placeholder.com/100' }}" 
                    alt="{{ $siswaItem->nama }}" 
                    class="h-16 w-16 rounded-full object-cover mr-4">
                
                <div>
                    <h2 class="text-lg font-semibold">{{ $siswaItem->nama }}</h2>
                    <p class="text-gray-500">ID: {{ $siswaItem->id }}</p>
                </div>
            </div>

            <div class="p-4 border-t border-gray-200">
                <a href="{{ route('messages.conversation', $siswaItem->id) }}" class="text-blue-600 hover:underline">View Conversation</a>
                <a href="{{ route('messages.send', $siswaItem->id) }}" class="text-green-600 hover:underline ml-4">Send Message</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
