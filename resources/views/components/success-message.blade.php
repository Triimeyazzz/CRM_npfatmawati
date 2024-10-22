@if(session('success'))
    <div
        x-data="{
            show: true,
            message: '{{ session('success') }}',
            progress: 0,
            progressInterval: null,
            init() {
                this.progressInterval = setInterval(() => {
                    this.progress += 1;
                    if (this.progress >= 100) {
                        clearInterval(this.progressInterval);
                        setTimeout(() => this.show = false, 300);
                    }
                }, 50);
            },
            pause() {
                clearInterval(this.progressInterval);
            },
            resume() {
                this.init();
            },
            close() {
                clearInterval(this.progressInterval);
                this.show = false;
            }
        }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        @mouseover="pause"
        @mouseleave="resume"
        class="fixed bottom-4 right-4 w-80 bg-white rounded-lg shadow-xl overflow-hidden"
        role="alert"
    >
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900" x-text="message"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="close" class="inline-flex text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-green-100">
            <div class="h-1 bg-green-500 transition-all ease-out duration-1000" :style="{ width: `${progress}%` }"></div>
        </div>
    </div>
@endif