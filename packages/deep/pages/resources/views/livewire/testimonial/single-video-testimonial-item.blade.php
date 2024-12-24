<div class="col-span-12 md:col-span-4 mb-3 swiper-slide group h-full p-2">
    <div class="h-full card p-3" wire:click="$dispatch('showPodcast', { url: '{{ $i->url }}' })">
        <div class="flex items-center justify-center flex-col h-full">
            <img src="{{ optional($i->media)->path }}" alt="">
            <h3 class="text-center font-bold text-xl text-action mt-3">{{ $i->name }}</h3>
            <p class="text-center font-bold">{{ $i->role }}</p>
        </div>
    </div>
</div>