<div>
    @if( Auth::check() )
        <h2 class="text-xl font-bold">Share a review</h2>
        <form wire:submit.prevent="submit" method="POST" class="p-5 deepShadow mb-10">
            <div class="fijb">
                <div>
                    <label for="message" class="formLabel">Give Stars</label>
                    <div class="flex items-center mt-2 mb-4">
                        <svg class="{{ $star >= 1 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" wire:click="stars(1)"/></svg>
                        <svg class="{{ $star >= 2 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" wire:click="stars(2)"/></svg>
                        <svg class="{{ $star >= 3 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" wire:click="stars(3)"/></svg>
                        <svg class="{{ $star >= 4 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" wire:click="stars(4)"/></svg>
                        <svg class="{{ $star >= 5 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" wire:click="stars(5)"/></svg>
                    </div>
                </div>
                @if( !optional($old_review)->media || !count( optional($old_review)->media ) )
                    <div class="col-span-12 md:col-span-3">
                        <label class="formLabel">Images</label>
                        <input type="file" wire:model="images_upload" multiple>
                        @error('images_upload') <span class="error">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="message" class="formLabel">Review</label>
                <textarea type="text" wire:model="review" class="h-40 formInput" placeholder="Your Views" required></textarea>
                @error('review') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="text-center mt-5">
                <button class="btn" wire:loading.remove>Submit</button>
                <span wire:loading class="btn">Submit</span>
            </div>
        </form>
    @else
        <div class="text-center">
            <h2 class="text-xl font-bold my-10">Please Login to submit a review</h2>
            <a href="/login" class="btn">Login</a>
        </div>
    @endif

    @if( $reviews && count( $reviews ) )
        <h2 class="heading">@if( $star_selected ) {{ $star_selected }} Star Reviews @else All Reviews @endif</h2>
        <div class="row">
            <div class="col-span-12 md:col-span-4">
                <p class="text-center">{{ count( $reviews) }} Total Reviews</p>

                <div class="pr-5">
                    @foreach ([5, 4, 3, 2, 1] as $star)
                        @php
                            $percentage = $star_ratings[$star] ?? 0;
                        @endphp
                        <div class="flex items-center mb-2 hover:cursor-pointer" wire:click="change_star( {{ $star }} )" wire:key="star-{{ $star }}">
                            <p class="mr-2">{{ $star }} Star</p>
                            <div class="flex-1 relative rounded-md overflow-hidden" style="height: 20px; background: #eee">
                                <div style="width: {{ $percentage }}%;" class="bg-action absolute h-full">&nbsp;</div>
                            </div>
                            <p class="ml-2">{{ $percentage }}%</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-span-12 md:col-span-8">
                @if( $image_reviews && count( $image_reviews ) )
                    @if( count($image_reviews)< 4 )
                        <div class="row">
                            @foreach($image_reviews as $key => $i) 
                                <div class="rounded-md overflow-hidden" wire:key="image_reviews-img-{{ $loop->index}}" wire:click="openReviewModal( '{{ $i->id }}' )">
                                    <img  src="/storage/review/small/{{ optional($i->media)->media }}" alt="{{ optional($i->media)->alt }}" class="imgExpand hover:cursor-pointer">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div wire:ignore class="relative" x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, { 
                        loop: true,  centeredSlides: true,
                        observer: true, observeParents: true, 
                        slidesPerView: 1, spaceBetween: 10, grabCursor: true, breakpoints: {
                                640: { slidesPerView: 1, spaceBetween: 0, },
                                768: { slidesPerView: 2, spaceBetween: 10, },
                                1200: { slidesPerView: 3, spaceBetween: 10, }, }, })">
                            <div class="swiper-container" x-ref="container">
                                <div class="swiper-wrapper py-5">
                                    @foreach($image_reviews as $i)
                                        <div class="swiper-slide group p-2" wire:key="image_reviews-slide-{{ $loop->index}}" data-attr="{{ $i->id }}" @click="handleSlideClick({{ $i->id }})">
                                            <div class="rounded-md overflow-hidden">
                                                <img  src="/storage/review/small/{{ optional($i->media)->media }}" alt="{{ optional($i->media)->alt }}" class="imgExpand hover:cursor-pointer">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <x-swiper-button/>
                        </div>
                    @endif
                @endif

                @if( $starred_reviews && count( $starred_reviews) )
                    @foreach($starred_reviews as $key => $i)
                        <div class="p-3 mb-5 border-b-2" wire:key="srit-{{ $loop->index }}">
                            <div class="fijb">
                                <div class="flex items-center mt-3">
                                    <div class="mr-3 bg-action rounded-full flex items-center justify-center" style="height: 40px; width: 40px">
                                        <p class="font-bold text-white text-xl">{{substr( optional($i->user)->name, 0, 1 )}}</p>
                                    </div>
                                    <div>
                                        <p class="leading-4"><strong>{{ optional($i->user)->name }}</strong> says</p>
                                        <small>{{ \Carbon\Carbon::parse($i->updated_at)->isoFormat('Do MMM YYYY') }}</small>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="{{ $i->rating >= 1 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="{{ $i->rating >= 2 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="{{ $i->rating >= 3 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="{{ $i->rating >= 4 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="{{ $i->rating >= 5 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                </div>
                            </div>
                            <p class="comment py-2 relative text-xs sm:text-sm">{{ $i->review }}</p>

                            @if( $i->media && count( $i->media ) )
                                <div class="flex flex-wrap items-center py-3">
                                    @foreach( $i->media as $j )
                                        <img src="/storage/review/thumbnail/{{ optional($j->media)->media }}" alt="{{ optional($j->media)->alt }}" class="rounded-md mr-3 overflow-hidden hover:cursor-pointer" style="max-height: 60px; width: auto; margin-right: 10px;" wire:click="$dispatch( 'openReviewModal', { id: '{{ $j->id }}' } )" wire:key="sri-media-{{ $j->id }}">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

    @if( $isOpen && $active_review )
        <div class="bg-dark fixed h-full left-0 top-0 w-full z-50 flex items-center justify-center">
            <div class="bg-white animated fade border fixed overflow-y-auto w-full z-20" style="max-width: 80vw; height: fit-content">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center" style="z-index: 100; position: relative">
                    <h2 class="font-bold w-full">Reviews</h2>
                    <img wire:click="closeModal()" src="/images/icons/static/cross.svg" class="h-6 w-6 ml-auto hover:cursor-pointer">
                </div>
                <div class="row items-center p-5">
                    <div class="col-span-12 md:col-span-7">
                        <div class="z-50 absolute bottom-1 md:inset-y-0 left-0 flex items-center overflow-hidden">
                            <img wire:click="leftActive()" src="/images/icons/static/left-arrow-colored.svg" alt="{{ config('deep.brand') }}" class="w-10 h-10 hover:cursor-pointer">
                        </div>
                        <img src="{{ optional($active_review->media)->path }}" alt="" classs="p-2">
                        <div class="z-50 absolute bottom-1 md:inset-y-0 right-0 flex items-center overflow-hidden">
                            <img wire:click="rightActive()" src="/images/icons/static/right-arrow-colored.svg" alt="{{ config('deep.brand') }}"  class="w-10 h-10 hover:cursor-pointer">
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-5">
                        <div class="p-3">
                            <div class="fijb">
                                <div class="flex items-center mt-3">
                                    <div class="mr-3 bg-action rounded-full flex items-center justify-center" style="height: 40px; width: 40px">
                                        <p class="font-bold text-white text-xl">{{substr( optional(optional($active_review->review)->user)->name, 0, 1 )}}</p>
                                    </div>
                                    <div>
                                        <p class="leading-4"><strong>{{ optional(optional($active_review->review)->user)->name }}</strong> says</p>
                                        <small>{{ optional($active_review->review)->updated_at->diffForHumans()}}</small>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="{{ optional($active_review->review)->rating >= 1 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="{{ optional($active_review->review)->rating >= 2 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="{{ optional($active_review->review)->rating >= 3 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="{{ optional($active_review->review)->rating >= 4 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="{{ optional($active_review->review)->rating >= 5 ? 'text-action' : 'text-gray-400' }} cursor-pointer mr-3 mx-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                </div>
                            </div>
                            
                            <p class="comment py-2 relative text-xs sm:text-sm">{{ optional($active_review->review)->review }}</p>

                            @if( optional($active_review->review)->media && count( optional($active_review->review)->media ) )
                                <div class="flex flex-wrap items-center py-3">
                                    @foreach( optional($active_review->review)->media as $j )
                                        <img src="/storage/review/thumbnail/{{ optional($j->media)->media }}" alt="{{ optional($j->media)->alt }}" class="rounded-md m-2 overflow-hidden hover:cursor-pointer" style="max-height: 60px; width: auto; margin-right: 10px;" wire:click="$emit( 'openReviewModal', '{{ $j->id }}' )" wire:key="sri-rf-media-{{ $j->id }}">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push("scripts")
        <script>
            function handleSlideClick( id ) {
                @this.call('openReviewModal', id)
            }
        </script>
    @endpush
</div>