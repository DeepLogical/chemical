<div class="col-span-12 md:col-span-4 mb-3 swiper-slide group h-full p-2">
    <div class="h-full card p-3">
        <div class="pb-3">
            <h3 class="font-bold text-xl mt-3">{{ $i->name }}</h3>
            <p class="font-bold">{{ $i->role }}</p>
        </div>
        <div class="flex items-center justify-center flex-col h-full">
            {!! $i->testis !!}
        </div>
    </div>
</div>