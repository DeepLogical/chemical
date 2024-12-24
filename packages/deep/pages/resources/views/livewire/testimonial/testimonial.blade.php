<div>
    @if($data && count($data) )
        <div class="container py-3 md:py-5">
            @livewire('headerCrumbOne', [ "heading" => $heading, "paragraph" => $paragraph ])

            @if( count($data)< 4 )
                <div class="row">
                    @foreach($data as $key => $i) @livewire('singleTestimonialItem', [ "i" => $i, key($key) ]) @endforeach
                </div>
            @else
                <div class="swiper-container py-5 relative" x-ref="container" x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, { loop: true, slidesPerView: 1, spaceBetween: 0, breakpoints: {
                    640: { slidesPerView: 1, spaceBetween: 10, },
                    768: { slidesPerView: 2, spaceBetween: 10, },
                    1200: { slidesPerView: 3, spaceBetween: 10, }, }, })">
                    <div class="swiper-wrapper">
                        @foreach($data as $i) @livewire('singleTestimonialItem', [ "i" => $i, key($key) ]) @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>