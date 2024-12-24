<div class="container py-5">
    <h1 class="heading">Website Sitemap</h1>
    <p class="text-center">Below sitemap will help you browse through the website</p>
    <h2><a href="/" class="font-semibold pt-5">Home Page</a></h2>
    <ul class="flex flex-wrap items-center mb-2">
        @foreach($pages as $key=>$i)
            <li wire:key="pages-{{ $loop->index}}"><a href="{{ $i['url']}}" class="text-sm hover:text-action">{{ $i->name }}</a><span class="px-3"> @if($key != count($pages) -1 ) | @endif </span> </li>
        @endforeach
    </ul>
    <h2 class="font-semibold pt-2">Social Media Pages</h2>
    <ul class="flex flex-wrap items-center mb-2">
        @foreach( config('deep.social')  as $key=>$i)
            <li wire:key="social-{{ $loop->index}}"><a href="{{ $i['url']}}" class="text-sm hover:text-action">{{ $i['platform']}}</a><span class="px-3"> @if($key != count( config('deep.social') ) -1 ) | @endif </span> </li>
        @endforeach
    </ul>
    <h2 class="font-semibold pt-2">Blogs</h2>
    <ul class="flex flex-wrap items-center mb-2">
        @foreach($blogs as $key=>$i)
            <li wire:key="blogs-{{ $loop->index}}"><a href="/{{ $i->url }}" class="text-sm hover:text-action">{{ $i->name }}</a><span class="px-3"> @if($key != count($blogs) -1 ) | @endif </span> </li>
        @endforeach
    </ul>
    <h2 class="font-semibold pt-2">Blog Categories</h2>
    <ul class="flex flex-wrap items-center mb-2">
        @foreach($cat as $key=>$i)
            <li wire:key="cat-{{ $loop->index}}"><a href="/{{ $i->type }}/{{ $i->url }}" class="text-sm hover:text-action">{{ $i->name }}</a><span class="px-3"> @if($key != count($cat) -1 ) | @endif </span> </li>
        @endforeach
    </ul>
    <h2 class="font-semibold pt-2">Blog Tags</h2>
    <ul class="flex flex-wrap items-center mb-2">
        @foreach($tag as $key=>$i)
            <li wire:key="tag-{{ $loop->index}}"><a href="{{ $i->url }}" class="text-sm hover:text-action">{{ $i->name }}</a><span class="px-3"> @if($key != count($tag) -1 ) | @endif </span> </li>
        @endforeach
    </ul>
</div>