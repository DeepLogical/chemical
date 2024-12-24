<section class="py-5">
    <link rel="stylesheet" href="{{ asset('/css/map.css') }}">
    <style>
        #map{
            position: sticky !important;
            right: 0;
            right: 0;
            left: 0;
            top: 0;
            height: 90vh;
        }
    </style>
    
    <div id="map" class="w-full" wire:ignore></div>

    @push('scripts')
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('deep.google_map_key') }}&callback=initMap&v=weekly&channel=2"async></script>
        <script>
            let map;
            let markers = [];
            let infoWindow;

            function initMap() {
                // Try to get the user's location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
                } else {
                    // Default location
                    initMapWithLocation(28.4231603, 76.8249363);
                }
            }

            function successCallback(position) {
                initMapWithLocation(position.coords.latitude, position.coords.longitude);
                @this.call('checkLocation', position.coords.latitude, position.coords.longitude);
            }

            function errorCallback(error) {
                initMapWithLocation(28.4231603, 76.8249363);
            }

            function initMapWithLocation(latitude, longitude) {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: latitude, lng: longitude },
                    zoom: 7,
                });

                infoWindow = new google.maps.InfoWindow();

                addMarkers(@json($view), @json($data));
                
                if (@json($view) !== 'map') {
                    Livewire.emit('hideMap');
                }
            }

            function addMarkers(view, data) {
                // Clear existing markers
                markers.forEach(marker => marker.setMap(null));
                markers = [];

                data.forEach(function(i) {
                    const marker = new google.maps.Marker({
                        position: { lat: i.location[0], lng: i.location[1] },
                        map: map,
                        icon: '/images/icons/static/marker.svg',
                    });

                    marker.addListener('click', () => {
                        const contentString = `
                            <div>
                                <a href="${i.url}">
                                    <img src="${i.image}" alt="${i.title}" style="max-width: 200px; margin: 0 auto" >
                                    <div class="font-bold py-2" style="color: #000">${i.title}</div>
                                    ${i.date ? `
                                    <div class="flex items-center">
                                        <img src="/images/icons/static/calendar-black.svg" style="max-width: 20px; color: #000" class="mr-1">
                                        <span style="color: #000">${i.date}</span>
                                    </div>` : ''}
                                </a>
                            </div>`;

                        infoWindow.setContent(contentString);
                        infoWindow.open(map, marker);
                    });

                    markers.push(marker);
                });

                if (view !== 'map') {
                    Livewire.emit('hideMap');
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                Livewire.on('refreshMap', (view, data) => { addMarkers(view, data); });
            });
        </script>
    @endpush
</section>