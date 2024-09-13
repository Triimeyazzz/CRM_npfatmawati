@extends('layouts.homelayout')

@section('title', 'About Primagama Fatmawati')

@section('styles')
<style>
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }
    .timeline-item {
        opacity: 0;
        transform: translateX(-50px);
        transition: opacity 0.5s, transform 0.5s;
    }
    .timeline-item.show {
        opacity: 1;
        transform: translateX(0);
    }
    .team-member {
        opacity: 0;
        transform: scale(0.8);
        transition: opacity 0.3s, transform 0.3s;
    }
    .team-member.show {
        opacity: 1;
        transform: scale(1);
    }
    .value-card {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.3s, transform 0.3s;
    }
    .value-card.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endsection

@section('content')
<div class="bg-gradient-to-r from-purple-100 to-blue-100 min-h-screen p-8">
    <h1 class="text-5xl font-bold text-center mb-12 text-purple-800 opacity-0 transform -translate-y-10" id="main-title">
        About Primagama Fatmawati
    </h1>

    <div class="w-full max-w-4xl mx-auto">
        
        <div id="tabContentExample">
            <div class="tab-content active p-4 rounded-lg bg-white shadow-md mt-6" id="intro" role="tabpanel" aria-labelledby="intro-tab">
                <h2 class="text-2xl font-semibold mb-4">Welcome to Primagama Fatmawati</h2>
                <img src="{{ asset('images/primagama-building.jpg') }}" alt="Primagama Fatmawati Building" class="w-full rounded-lg shadow-lg mb-6">
                <p class="text-lg text-gray-700">
                    Primagama Fatmawati is a leading educational institution committed to nurturing the next generation of leaders and innovators. With our state-of-the-art facilities and dedicated team of educators, we strive to provide an unparalleled learning experience for our students.
                </p>
            </div>
            <div class="tab-content p-4 rounded-lg bg-white shadow-md mt-6" id="history" role="tabpanel" aria-labelledby="history-tab">
                <h2 class="text-2xl font-semibold mb-4">Our Rich History</h2>
                <ul class="space-y-4">
                    @foreach([1990, 2000, 2010, 2020] as $year)
                        <li class="timeline-item flex items-center space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ $year }}
                            </div>
                            <div class="flex-grow">
                                <h3 class="text-lg font-semibold">Major Milestone</h3>
                                <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-content p-4 rounded-lg bg-white shadow-md mt-6" id="mission" role="tabpanel" aria-labelledby="mission-tab">
                <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
                <p class="text-lg text-gray-700 mb-4">
                    At Primagama Fatmawati, our mission is to provide high-quality education that nurtures critical thinking, creativity, and character. We are committed to:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>Fostering a love for learning</li>
                    <li>Developing well-rounded individuals</li>
                    <li>Preparing students for global challenges</li>
                    <li>Promoting innovation and excellence</li>
                </ul>
            </div>
            <div class="tab-content p-4 rounded-lg bg-white shadow-md mt-6" id="team" role="tabpanel" aria-labelledby="team-tab">
                <h2 class="text-2xl font-semibold mb-4">Our Team</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach(['Raifan' => 'CEO', 'Trimei' => 'CTO', 'Jane Doe' => 'COO', 'John Smith' => 'CMO'] as $name => $role)
                        <div class="team-member text-center">
                            <img src="{{ asset('images/placeholder.jpg') }}" alt="{{ $name }}" class="w-32 h-32 rounded-full mx-auto mb-2">
                            <h3 class="font-semibold">{{ $name }}</h3>
                            <p class="text-sm text-gray-600">{{ $role }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-content p-4 rounded-lg bg-white shadow-md mt-6" id="values" role="tabpanel" aria-labelledby="values-tab">
                <h2 class="text-2xl font-semibold mb-4">Our Core Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach(['Integrity', 'Innovation', 'Excellence'] as $value)
                        <div class="value-card bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold text-purple-800 mb-2">{{ $value }}</h3>
                            <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 text-center">
        <button id="watchStoryBtn" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Watch Our Story
        </button>
    </div>

    <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-4 rounded-lg w-full max-w-3xl">
            <div class="flex justify-end mb-2">
                <button id="closeVideoBtn" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="aspect-w-16 aspect-h-9">
                <iframe 
                    src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                    frameborder="0" 
                    allow="autoplay; encrypted-media" 
                    allowfullscreen
                    class="w-full h-full"
                ></iframe>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-3xl font-bold text-center mb-6">Find Us</h2>
        <div class="aspect-w-16 aspect-h-9">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.806268294965!2d106.7925888740973!3d-6.289176161555781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1ead17c309f%3A0xc1f346ea893a18be!2sZENIUS%20CENTER!5e0!3m2!1sid!2sid!4v1720591356159!5m2!1sid!2sid" 
                width="100%" 
                height="450" 
                style="border: 0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Animate main title
        document.getElementById('main-title').classList.add('opacity-100', 'translate-y-0', 'transition-all', 'duration-500', 'ease-out');

        // Tab functionality
        const tabs = document.querySelectorAll('[role="tab"]');
        const tabContents = document.querySelectorAll('[role="tabpanel"]');

        tabs.forEach(tab => {
            tab.addEventListener('click', changeTabs);
        });

        function changeTabs(e) {
            const target = e.target;
            const parent = target.parentNode;
            const grandparent = parent.parentNode;

            // Remove all current selected tabs
            grandparent.querySelectorAll('[aria-selected="true"]').forEach(t => t.setAttribute('aria-selected', false));

            // Set this tab as selected
            target.setAttribute('aria-selected', true);

            // Hide all tab panels
            tabContents.forEach(content => {
                content.classList.remove('active');
            });

            // Show the selected panel
            const tabPanel = document.querySelector(target.getAttribute('data-tabs-target'));
            tabPanel.classList.add('active');

            // Trigger animations for the newly active tab
            if (tabPanel.id === 'history') {
                animateTimeline();
            } else if (tabPanel.id === 'team') {
                animateTeam();
            } else if (tabPanel.id === 'values') {
                animateValues();
            }
        }

        // Animate timeline on page load
        animateTimeline();

        function animateTimeline() {
            const timelineItems = document.querySelectorAll('.timeline-item');
            timelineItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('show');
                }, index * 200);
            });
        }

        function animateTeam() {
            const teamMembers = document.querySelectorAll('.team-member');
            teamMembers.forEach((member, index) => {
                setTimeout(() => {
                    member.classList.add('show');
                }, index * 100);
            });
        }

        function animateValues() {
            const valueCards = document.querySelectorAll('.value-card');
            valueCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('show');
                }, index * 100);
            });
        }

        // Video modal functionality
        const watchStoryBtn = document.getElementById('watchStoryBtn');
        const videoModal = document.getElementById('videoModal');
        const closeVideoBtn = document.getElementById('closeVideoBtn');

        watchStoryBtn.addEventListener('click', () => {
            videoModal.classList.remove('hidden');
        });

        closeVideoBtn.addEventListener('click', () => {
            videoModal.classList.add('hidden');
        });
    });
</script>
@endsection