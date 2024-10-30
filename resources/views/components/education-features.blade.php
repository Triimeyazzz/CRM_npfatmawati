{{-- resources/views/components/education-features.blade.php --}}

{{-- Alpine.js untuk handling interaktivitas --}}
<div class="bg-white py-8 px-4" x-data="{ openModal: null }">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-purple-800 mb-4">
                Mengapa Harus Belajar
            </h1>
            <h2 class="text-2xl font-bold text-purple-800 mb-4">
                di New Primagama Fatmawati
            </h2>
            <div class="inline-block bg-purple-700 text-white px-8 py-2 rounded-lg text-lg">
                Temukan keunggulan belajar bersama kami
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($contentData as $index => $feature)
                @if($index > 0)
                    <div class="relative group" x-data="{ isOpen: false }">
                        {{-- Card Container --}}
                        <div class="bg-pink-50 rounded-2xl p-6 shadow-lg transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                            {{-- Image Container --}}
                            <div class="flex justify-center mb-4">
                                <div class="w-32 h-32 rounded-lg overflow-hidden">
                                    <img src="{{ $feature['imgSrc'] }}" alt="{{ $feature['imgAlt'] }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                            
                            {{-- Content Container --}}
                            <div class="text-center">
                                {{-- Title Badge --}}
                                <div class="bg-amber-400 text-black px-4 py-2 rounded-full mb-4 inline-block text-sm font-medium shadow-md">
                                    {{ $feature['heading'] }}
                                </div>
                                
                                {{-- Description --}}
                                <p class="text-gray-600 text-sm mb-4 px-2">
                                    {{ $feature['text'] }}
                                </p>
                                
                                {{-- Button --}}
                                <button 
                                    @click="openModal = {{ $feature['id'] }}"
                                    class="bg-purple-700 text-white px-8 py-1.5 rounded-full text-sm font-medium hover:bg-purple-800 transition-colors shadow-md">
                                    LIHAT
                                </button>
                            </div>
                        </div>
                        
                        {{-- Border Decoration --}}
                        <div class="absolute inset-0 -z-10 translate-x-2 translate-y-2 rounded-2xl border-2 border-amber-400"></div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- Modal untuk detail informasi --}}
    <template x-for="feature in $data.features" :key="feature.id">
        <div 
            x-show="openModal === feature.id" 
            @click.away="openModal = null"
            x-cloak
            class="fixed inset-0 z-50 overflow-y-auto"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

                <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button 
                            @click="openModal = null" 
                            class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close</span>
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4" x-text="feature.heading"></h3>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500" x-text="feature.text"></p>
                        </div>
                        <div class="mt-4">
                            <h4 class="font-medium text-gray-900 mb-2">Informasi Tambahan:</h4>
                            <ul class="list-disc list-inside text-sm text-gray-500">
                                <template x-if="feature.id === 2">
                                    <div>
                                        <li>Akses 24/7 ke seluruh konten premium</li>
                                        <li>Video pembelajaran interaktif</li>
                                        <li>Bank soal lengkap</li>
                                        <li>Progress tracking</li>
                                    </div>
                                </template>
                                <!-- Tambahkan informasi tambahan untuk fitur lainnya -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

{{-- Tambahkan style --}}
<style>
    [x-cloak] {
        display: none !important;
    }
    
    .group:hover .rounded-2xl {
        transform: translateY(-4px);
    }
    
    .group:hover .absolute {
        transform: translate(10px, 10px);
        transition: all 0.3s ease;
    }
</style>

