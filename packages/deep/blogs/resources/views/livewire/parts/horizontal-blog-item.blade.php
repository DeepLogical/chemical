<a href="{{ $i->url }}" class="my-5 block">
    <div class="deepShadow min-h-400 flex flex-col items-center justify-center  bg-cover group amitBtnGroup" style="background-image: url('/storage/blog/{{ optional($i->media)->media}}');">
        <h3 class="text-center font-semibold oneliner pt-2 text-2xl">{{ $i->name }}</h3>
        <div class="text-center my-5"><button class="btn">Read More</button></div>
    </div>
</a>