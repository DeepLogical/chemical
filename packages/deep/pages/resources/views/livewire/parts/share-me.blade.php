<ul class="flex items-center justify-center share">
    <style>
        .share li{
            list-style-type: none !important;
        }
        .share a:after{
            display: none
        }
    </style>
    <li class="font-bold">Share with friend & Family :</li>
    @foreach( config('deep.share') as $key => $i)
        <li wire:key="share-{{$key}}" class="group">
            <a href="{{ $i['url'] }}{{ config('deep.site') }}/{{ $url }}" target="_blank">
                <img src="/images/icons/social/{{ $i['img'] }}" class="w-4 mx-3 transition duration-500 ease-in-out group-hover:scale-150"/>
            </a>
        </li>
    @endforeach
</ul>