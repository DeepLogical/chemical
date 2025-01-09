<div class="col-span-12 md:col-span-6 h-full mb-5 group deepShadow rounded-md">
    <div class="overflow-hidden">
        <img src="/storage/product/small/{{ optional($i->media)->media}}" alt="{{ optional($i->media)->alt }}" class="imgExpand rounded-t-lg" loading="lazy" width="430" height="235">
    </div>
    <div class="p-5">
        <h5 class="font-semibold text-xl oneliner">{{ $i->name }}</h5>
        <p class="flex "><strong class="font-bold pr-2">Manufacturer: </strong> {{$i->manufacturer}}</p>
        <p class="flex"><strong class="font-bold pr-2">Product functions: </strong> {{$i->functions}}</p>
        <p class=""><strong class="font-bold pr-2">TDS Code: </strong>{{$i->tds}}</p>
        <p class=""><strong class="font-bold pr-2">End Applications: </strong>{{$i->end}}</p>

        <a href="{{ route('productSingle', ['url' => $i->url] ) }}" class="btn">Read More</a>

    </div>
</div>