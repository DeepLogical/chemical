@if($data && count($data))
    <div class="container">
        @livewire('headerCrumbTwo', [ "heading" => $heading, "paragraph" => $paragraph ])

        @if(count($data) < 4)
            <div class="row">
                @foreach($data as $key => $i)
                    @livewire('singleBlogItem', [ "i" => $i, 'key' => $key ]) 
                @endforeach
            </div>
        @else
            <div class="suggestBlogs relative" x-data="{ swiper: null }" x-init="swiper = new Swiper($refs.container, { 
                loop: true, 
                slidesPerView: 1, 
                spaceBetween: 10, 
                centeredSlides: true, 
                grabCursor: true, 
                breakpoints: {
                    640: { slidesPerView: 1, spaceBetween: 0 },
                    768: { slidesPerView: 2, spaceBetween: 10 },
                    1200: { slidesPerView: 3, spaceBetween: 10 },
                }
            })">
                <div class="swiper-container" x-ref="container">
                    <div class="swiper-wrapper py-5">
                        @foreach($data as $i)
                            <div class="swiper-slide group p-2" wire:key="suggestblog-{{ $loop->index }}">
                                @livewire('singleBlogItem', [ "i" => $i ])
                            </div>
                        @endforeach
                    </div>
                </div>
                <x-swiper-button/>
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('blogs') }}" class="btn my-5">Click For More</a>
        </div>
    </div>
@else
    <div class="container py-3 md:py-5 text-center">
        <p>No blogs available at the moment.</p>
    </div>
@endif
