<div class="col-span-12 md:col-span-6 h-full group deepShadow rounded-md overflow-hidden">
    <a href="/{{ $i->url }}" class="block overflow-hidden">
        <img src="/storage/blog/small/{{ optional($i->media)->media}}" alt="{{ optional($i->media)->alt }}" class="imgExpand" loading="lazy" width="430" height="235">
    </a>
    <div class="flex items-center justify-between p-2 md:p-3">
        <div class="flex items-center">
            <img src="/images/icons/static/gift.svg" alt="" class="w-4 mr-3">
            <a href="/category/{{ optional(optional($i->category)->first())->url }}" class="group-hover:text-action">{{ optional(optional($i->category)->first())->name }}</a>
        </div>
        <div class="flex items-center">
            <img src="/images/icons/static/clock.svg" alt="" class="w-4 mr-3">
            <p class="group-hover:text-action">{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY') }}</p>
        </div>
    </div>
    <div class="p-2 md:p-3">
        <h5 class="font-semibold text-xl oneliner">{{ $i->name }}</h5>
        <div class="twoliner">{!! $i->excerpt !!}</div>
        <div class="py-2">
            <a href="/{{ $i->url }}" class="btn">Read More</a>
        </div>
    </div>
</div>