<a href="{{ $i->url }}" class="flex items-center block relative verticalTint">
    <img src="/storage/product/small/{{ optional($i->media)->media}}" alt="{{ optional($i->media)->alt }}" loading="lazy" width="500" height="270"/>
    <div class="absolute bottom-0 left-0 right-0 text-center z-50 p-2">
        <p class="text-white mb-1 twoliner text-sm text-center">{{ $i->name }}</p>
        <small class="text-white text-xs">{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY') }}</small>
    </div>
</a>