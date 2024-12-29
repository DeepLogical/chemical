<div class="col-span-12 md:col-span-6 h-full group deepShadow rounded-md overflow-hidden">
    <a href="/{{ $i->url }}" class="block overflow-hidden">
        <img src="/storage/product/small/{{ optional($i->media)->media}}" alt="{{ optional($i->media)->alt }}" class="imgExpand" loading="lazy" width="430" height="235">
    </a>
    <div class="p-2 md:p-3">
        <h5 class="font-semibold text-xl oneliner">{{ $i->name }}</h5>
        <p class="flex "><strong class="font-bold pr-2">Manufacturer: </strong> {{$i->manufacturer}}</p>
        <p class="flex"><strong class="font-bold pr-2">Product functions: </strong> {{$i->functions}}</p>
        <p class=""><strong class="font-bold pr-2">TDS Code: </strong>{{$i->tds}}</p>
        <p class=""><strong class="font-bold pr-2">End Applications: </strong>{{$i->end}}</p>
        <div class="py-2">
            <a href="/{{ $i->url }}" class="btn">Order</a>
        </div>
    </div>
</div>