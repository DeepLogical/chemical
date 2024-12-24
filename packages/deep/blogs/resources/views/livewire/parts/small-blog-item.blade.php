<a href="/{{ $i->url }}" class="flex items-center p-2">
    <img src="/storage/blog/small/{{ optional($i->media)->media}}" alt="{{ optional($i->media)->alt }}" class="rounded max-w-100 mr-3" loading="lazy" width="100" height="50" />
    <div>
        <p class="twoliner text-sm">{{ $i->name }}</p>
        <small class="text-xs">{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY') }}</small>
    </div>
</a>