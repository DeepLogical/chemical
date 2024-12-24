<div class="col-span-12 md:col-span-6 h-full mb-5 group deepShadow rounded-md">
    <a href="/{{ $i->url }}" class="block overflow-hidden">
        <img src="/storage/blog/small/{{ optional($i->media)->media}}" alt="{{ optional($i->media)->alt }}" class="imgExpand rounded-t-lg" loading="lazy" width="430" height="235">
    </a>
    <div class="flex items-center justify-between p-2">
        <p><a class="" href="/category/{{ optional(optional($i->category)->first())->url }}">{{ optional(optional($i->category)->first())->name }}</a></p>
        <p class="text-action">{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY') }}</p>
    </div>
    <div class="p-3">
        <h5 class="font-semibold text-center text-xl">{{ $i->name }}</h5>
        <div class="twoliner">{!! $i->excerpt !!}</div>
        <div class="mt-3">
            <a href="/{{ $i->url }}" class="btn">Read More</a>
        </div>
    </div>
</div>