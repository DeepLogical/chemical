<div class="deepShadow rounded h-full relative overflow-hidden rounded bg-cover group amitBtnGroup" style="background-image: url('/storage/blog/{{ optional($i->media)->media}}');">
   
    <div class="p-3 absolute bottom-0 left-0">
        <h3 class="font-bold mb-2 text-center oneliner text-white">
            <a href="{{ $i->url }}">{{ $i->name }}</a>
        </h3>
        <small class="block text-center oneliner text-action font-bold">
            @for($j=0; $j < 2; $j++)
                @if($i->category && count( $i->category)>$j)
                    <a href="{{ $i->category[$j]['url']}}">{{ $i->category[$j]['name']}}</a>
                    @if($j == 0) &nbsp;|&nbsp; @endif
                @endif
            @endfor
        </small>
        <div class="flex sm:block lg:flex is-center justify-between pt-5 sm:text-center">
            <small class="font-bold text-xs sm:w-full sm:block sm:text-center lg:w-auto text-white">
                {{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY') }}
            </small>
            <a href="{{ $i->url }}" class="btn text-xs px-3 py-1">Read More</a>
        </div>
    </div>
</div>